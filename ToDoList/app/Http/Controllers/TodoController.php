<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Todo;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(TodoResource::collection(Todo::all()), Response::HTTP_OK) ; // get all to dos
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo_list_id' => 'required|exists:todo_lists,id',
            'task' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        $todo = Todo::create($request->all()); // create new to do
        return response()->json(new TodoResource($todo), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id); // find to do by id
        return response()->json(new TodoResource($todo), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->all()); // update to do
        return response()->json(new TodoResource($todo), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Todo::destroy($id); // delete to do
        return response()->json(null, 204);
    }
}
