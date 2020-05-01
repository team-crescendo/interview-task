<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStore;
use App\Http\Requests\TodoUpdate;
use App\Models\Todo;
use App\Services\ExportCSV;
use Illuminate\Http\Request;
use League\Csv\Writer;

class TodoController extends Controller
{
    // READ_ALL
    public function index()
    {
        $todos = Todo::all();

        return response()->forte(200, 'Successful', $todos);
    }

    // READ_ONE
    public function show($id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) return response()->forte(404, 'Not Found');

        return response()->forte(200, 'Successful', $todo);
    }

    // CREATE
    public function store(TodoStore $request)
    {
        $todo = Todo::create($request->all());

        return response()->forte(200, 'Successful', $todo);
    }

    // UPDATE
    public function update(TodoUpdate $request, $id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) return response()->forte(404, 'Not Found');

        $todo->update($request->only('title', 'completed'));

        return response()->forte(200, 'Successful', $todo);
    }

    // DELETE
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) return response()->forte(404, 'Not Found');

        $todo->delete();

        return response()->forte(200, 'Successful');
    }

    // DOWNLOAD
    public function download()
    {
        $todos = Todo::all();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['userId', 'id', 'title', 'completed']);

        foreach ($todos as $todo) {
            $csv->insertOne([$todo->user_id, $todo->id, $todo->title, ($todo->completed ? 'true' : 'false')]);
        }

        $csv->output('todos.csv');

        return;
    }

    // SEARCH
    public function search(Request $request)
    {
        if (!isset($request->title) && !isset($request->completed)) {
            return response()->forte(400, 'Parameter Required');
        }

        $todos = Todo::title($request->title)->completed($request->boolean('completed'))->get();

        return response()->forte(200, 'Successful', $todos);
    }
}
