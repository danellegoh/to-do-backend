<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['todo_list_id', 'task', 'completed'];

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
