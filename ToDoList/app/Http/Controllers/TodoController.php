<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all(); // get all to dos
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo_list_id' => 'required|exists:todo_lists,id',
            'task' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        $todo = Todo::create($request->all()); // create new to do
        return response()->json($todo, 201);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id); // find to do by id
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->all()); // update to do
        return response()->json($todo);
    }

    public function destroy($id)
    {
        Todo::destroy($id); // delete to do
        return response()->json(null, 204);
    }
}
