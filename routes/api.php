<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)
    ->middleware('auth:api')
    ->group(function ()
    {
        Route::post('auth/logout', 'logout');
        Route::post('auth/refresh', 'refresh');
    });

Route::controller(AuthController::class)
    ->group(function ()
    {
        Route::post('auth/reg', 'register');
        Route::post('auth/login', 'login');
    });


