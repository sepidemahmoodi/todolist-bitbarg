<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('Modules\toDoList\Http\Controllers\api')->prefix('api')->group(function () {
    // Route::apiResource('task-lists', 'TaskListApiController');
    Route::get('task-lists', 'TaskListApiController@index');
    Route::post('task-lists/create', 'TaskListApiController@store');
    Route::put('task-lists/edit/{id}', 'TaskListApiController@update');
    Route::delete('task-lists/delete/{id}', 'TaskListApiController@destroy');

    Route::get('task', 'TaskApiController@index');
    Route::post('task/create', 'TaskApiController@store');
    Route::put('task/edit/{id}', 'TaskApiController@update');
    Route::delete('task/delete/{id}', 'TaskApiController@destroy');
 } );

