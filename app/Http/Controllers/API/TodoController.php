<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rules\AllBoolean;
use App\Services\CsvService;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{

    public function index()
    {
        return Todo::getAll();
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required',
            'title' => 'required',
            'completed' => ['required', new AllBoolean()]
        ]);

        $todo = Todo::create([
            "userId" => $validatedData['userId'],
            "title" => $validatedData['title'],
            "completed" => (bool) $validatedData['completed']
        ]);

        return $todo;
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return $todo;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => '',
            'completed' => [new AllBoolean()]
        ]);

        $todo = Todo::findOrFail($id);

        $todo->title = $validatedData["title"];
        $todo->completed = $validatedData["completed"];

        return $todo;
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response(null, 204);
    }

    public function downloadCsv(CsvService $csv)
    {
        return $csv->export(Todo::getAll());
    }

    public function search(Request $request)
    {
        $search = $request->input("search");

        $search = str_replace("neq", "!=", $search);
        $search = str_replace("eq", "=", $search);
        $search = str_replace("equals", "=", $search);

        try {
            $todos = DB::table('todos')->whereRaw($search?:null)->get();
        } catch (\Exception $exception) {
            abort(500, "Search Failed");
        }

        if (count($todos) == 0)
        {
            abort(404, "No matching todos");
        }

        return $todos;
    }
}
