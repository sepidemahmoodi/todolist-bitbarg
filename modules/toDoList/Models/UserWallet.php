<?php

namespace Modules\toDoList\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\toDoList\Models\User;

class UserWallet extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'user_wallet';

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
