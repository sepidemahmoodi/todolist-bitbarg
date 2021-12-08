<?php

namespace Modules\toDoList\Observers;

use Modules\toDoList\Models\TaskUsers;
use Modules\toDoList\Models\UserWallet;

class TaskUsersObserver
{
    /**
     * Handle the TaskUsers "created" event.
     *
     * @param  \App\Models\TaskUsers  $taskUsers
     * @return void
     */
    public function created(TaskUsers $taskUsers)
    {
        // dd($taskUsers->users->wallet);
        $users = $taskUsers->users;
        foreach($users as $user) {
            if ($user->wallet) {
                $user->wallet->update(['deposit' => $user->wallet->deposit - config('wallet.' . config('user.'. $user->user_type))]);
            }
        }
    }

    /**
     * Handle the TaskUsers "updated" event.
     *
     * @param  \App\Models\TaskUsers  $taskUsers
     * @return void
     */
    public function updated(TaskUsers $taskUsers)
    {
        //
    }

    /**
     * Handle the TaskUsers "deleted" event.
     *
     * @param  \App\Models\TaskUsers  $taskUsers
     * @return void
     */
    public function deleted(TaskUsers $taskUsers)
    {
        //
    }

    /**
     * Handle the TaskUsers "restored" event.
     *
     * @param  \App\Models\TaskUsers  $taskUsers
     * @return void
     */
    public function restored(TaskUsers $taskUsers)
    {
        //
    }

    /**
     * Handle the TaskUsers "force deleted" event.
     *
     * @param  \App\Models\TaskUsers  $taskUsers
     * @return void
     */
    public function forceDeleted(TaskUsers $taskUsers)
    {
        //
    }
}
