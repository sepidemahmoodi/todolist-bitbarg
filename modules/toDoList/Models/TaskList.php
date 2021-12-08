<?php

namespace Modules\toDoList\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\toDoList\Models\Task;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskList extends Model
{
    use SoftDeletes,HasFactory;
    protected $guarded = [];
     protected $table = 'task_list';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
