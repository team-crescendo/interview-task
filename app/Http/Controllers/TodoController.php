<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStore;
use App\Http\Requests\TodoUpdate;
use Illuminate\Http\Request;
use App\Models\Todo;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TodoController extends Controller
{
    /**
     * Show all items
     * @return JsonResponse
     */
    public function index()
    {
        $todos = Todo::all();

        return response()->forte(200, 'Successful', $todos);
    }

    /**
     * Show one item
     * @param Todo $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) return response()->forte(404, 'Not Found');

        return response()->forte(200, 'Successful', $todo);
    }

    /**
     * Store item
     * @param TodoStore $request
     * @return JsonResponse
     */
    public function store(TodoStore $request)
    {
        $todo = Todo::create($request->all());

        return response()->forte(200, 'Successful', $todo);
    }

    /**
     * Update item
     * @param TodoUpdate $request
     * @param Todo $id
     * @return JsonResponse
     */
    public function update(TodoUpdate $request, $id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) return response()->forte(404, 'Not Found');

        $todo->update($request->only('title', 'completed'));

        return response()->forte(200, 'Successful', $todo);
    }

    /**
     * Destroy item
     * @param Todo $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) return response()->forte(404, 'Not Found');

        $todo->delete();

        return response()->forte(200, 'Successful');
    }

    /**
     * Download all items
     * @return BinaryFileResponse
     */
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

    /**
     * Search item with query parameter
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        if (!isset($request->title) && !isset($request->completed)) {
            return response()->forte(400, 'Parameter Required');
        }

        $todos = Todo::title($request->title)->completed($request->boolean('completed'))->get();

        return response()->forte(200, 'Successful', $todos);
    }
}
