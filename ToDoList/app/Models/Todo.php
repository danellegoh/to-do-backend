<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_list_id',
        'description',
        'is_done'
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
