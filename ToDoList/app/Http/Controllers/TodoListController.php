<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TodoList;
use App\Http\Resources\TodoListResource;

class TodoListController extends Controller
{
    public function index()
    {
        return response()->json(TodoListResource::collection(TodoList::all()), Response::HTTP_OK); // get all to do lists
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $todoList = TodoList::create($request->all()); // create new to do list
        return response()->json(new TodoListResource($todoList), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        // $todoList = TodoList::findOrFail($id); // find to do list by id
        $todoList = TodoList::with('todos')->findOrFail($id);
        return response()->json(new TodoListResource($todoList), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $todoList = TodoList::findOrFail($id);
        $todoList->update([
            'name' => $request->input('name'),
        ]); // update to do list
        return response()->json(new TodoListResource($todoList), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        TodoList::destroy($id); // delete to do list
        return response()->json(null, 204);
    }
}
