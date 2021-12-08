<?php

namespace Modules\toDoList\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\toDoList\Models\Task;
use Modules\toDoList\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskUsers extends Model
{
    use SoftDeletes,HasFactory;
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
