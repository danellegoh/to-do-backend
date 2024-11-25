<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoController;

// // Route::apiResource() creates routes for common actions- index, store, show, update, destroy
// Route::apiResource('todo-lists', TodoListController::class); 
// Route::apiResource('todos', TodoController::class);

Route::middleware([])->group(function() {
    Route::get('todo-lists', [TodoListController::class, 'index']);
    Route::post('todo-lists', [TodoListController::class, 'store']);
    Route::get('todo-lists/{todo_list_id}', [TodoListController::class, 'show']);
    Route::put('todo-lists/{todo_list_id}', [TodoListController::class, 'update']);
    Route::patch('todo-lists/{todo_list_id}', [TodoListController::class, 'update']);
    Route::delete('todo-lists/{todo_list_id}', [TodoListController::class, 'destroy']);

    Route::get('todos', [TodoController::class, 'index']);
    Route::post('todos', [TodoController::class, 'store']);
    Route::get('todos/{todo_id}', [TodoController::class, 'show']);
    Route::put('todos/{todo_id}', [TodoController::class, 'update']);
    Route::patch('todos/{todo_id}', [TodoController::class, 'update']);
    Route::delete('todos/{todo_id}', [TodoController::class, 'destroy']);
});