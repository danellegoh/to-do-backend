<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoController;

// Route::apiResource() creates routes for common actions- index, store, show, update, destroy
Route::apiResource('todo-lists', TodoListController::class); 
Route::apiResource('todos', TodoController::class);