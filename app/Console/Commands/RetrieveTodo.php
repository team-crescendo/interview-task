<?php

namespace App\Console\Commands;

use App\Models\Todo;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RetrieveTodo extends Command
{
    private $client;

    protected $signature = 'todo:retrieve';

    protected $description = 'Retrive Todo list from API';

    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function handle()
    {
        $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/todos');
        $todos = json_decode($response->getBody()->getContents());

        DB::table('todos')->truncate();

        $progressBar = $this->output->createProgressBar(count($todos));

        foreach ($todos as $todo) {
            Todo::create([
                'user_id' => $todo->userId,
                'title' => $todo->title,
                'completed' => $todo->completed
            ]);
            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
