<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\toDoList\Models\User;

class TaskListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        \DB::table('task_list')->insert([
            'title' => Str::random(10),
            'creator_id' =>  User::all()->random()->id,
        ]);
    }
}
