<?php

namespace App\Console\Commands;

use App\Todo;
use http\Exception;
use Illuminate\Console\Command;

class crawlTodo extends Command
{

    protected $signature = 'crawl:todo';
    protected $description = 'Crawl Todos from External API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if ($this->checkIfTodoExists()) {
            $this->askThenTruncateOrFail();
        }

        $this->info('Crawling Todos from API...');
        $todos = $this->crawlTodos();

        foreach ($todos as $todo) {
            Todo::create([
                "userId" => $todo->userId,
                "title" => $todo->title,
                "completed" => $todo->completed
            ]);
        }
        $this->info('Completed!');
    }

    private function checkIfTodoExists()
    {
        $count = Todo::count();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function askThenTruncateOrFail()
    {
        if ($this->confirm('Todo already exists. Would you like to reset?')) {
            Todo::truncate();
            $this->comment('Reset Completed!');
        } else {
            exit();
        }
    }

    private function crawlTodos()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos');

        return json_decode($response->getBody());
    }
}
