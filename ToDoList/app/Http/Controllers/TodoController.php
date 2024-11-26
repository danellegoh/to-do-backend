<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Todo;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(TodoResource::collection(Todo::all()), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'todo_list_id' => 'required|exists:todo_lists,id',
            'description' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'todo_list_id' => $validated['todo_list_id'],
            'description' => $validated['description'],
            'is_done' => false,
        ]);

        return response()->json(new TodoResource($todo), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return response()->json(new TodoResource($todo), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        
        $validated = $request->validate([
            'description' => 'sometimes|required|string|max:255',
            'is_done' => 'sometimes|boolean',
        ]);

        DB::beginTransaction();
        try {
            $todo->update($validated);
            DB::commit();
            
            // Reload the model to get fresh data
            $todo = $todo->fresh();
            
            return response()->json(new TodoResource($todo), Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update todo',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        Todo::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
