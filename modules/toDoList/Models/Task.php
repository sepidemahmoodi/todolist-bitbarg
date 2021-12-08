<?php

namespace Modules\toDoList\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\toDoList\Models\User;
use Modules\toDoList\Models\TaskUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $guarded = ['userIds'];

    public function saveRelation($userIds)
    {
        foreach ($userIds as $userId) {
             TaskUsers::create(['task_id' => $this->id, 'user_id' => $userId]);
            // $this->taskUsers()->attach(['user_id' => $userId]);
        }
    }

    public function deleteRelation()
    {
        $this->users()->detach();
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'task_users',
            'task_id',
            'user_id'
        );
    }


    public function taskUsers()
    {
        return $this->belongsToMany(User::class, 'task_users', 'task_id', 'user_id');
    }
}
