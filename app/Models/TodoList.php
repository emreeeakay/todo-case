<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model {

    protected $table = 'todoList';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description'
    ];

}
