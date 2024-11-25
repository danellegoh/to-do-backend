<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;

class TodoListController extends Controller
{
    public function index()
    {
        return TodoList::all(); // get all to do lists
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $todoList = TodoList::create($request->all()); // create new to do list
        return response()->json($todoList, 201);
    }

    public function show($id)
    {
        $todoList = TodoList::findOrFail($id); // find to do list by id
        return response()->json($todoList);
    }

    public function update(Request $request, $id)
    {
        $todoList = TodoList::findOrFail($id);
        $todoList->update($request->all()); // update to do list
        return response()->json($todoList);
    }

    public function destroy($id)
    {
        TodoList::destroy($id); // delete to do list
        return response()->json(null, 204);
    }
}
