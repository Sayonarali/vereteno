<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

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

Route::controller(UserController::class)
    ->group(function ()
    {
        Route::get('users', 'index');
        Route::get('user/{id}', 'show');
        Route::put('user/{id}', 'update');
        Route::patch('user/{id}', 'update');
        Route::delete('user/{id}', 'delete');
    });
