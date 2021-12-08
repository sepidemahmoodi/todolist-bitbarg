<?php

namespace Modules\toDoList\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User as ParentUser;
use Modules\toDoList\Models\UserWallet;
use Modules\toDoList\Models\Task;

class User extends ParentUser
{
    protected $guarded = [];

    public function tasks()
    {
        return $this->belongsToMany(
            Task::class,
            'task_users',
            'user_id',
            'task_id'
        );
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }
}
