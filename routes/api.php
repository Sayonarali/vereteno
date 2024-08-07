<?php

use App\Http\Auth\AuthController;
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
    ->prefix('v1/auth')
    ->middleware('auth:api')
    ->group(function ()
    {
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
    });

Route::controller(AuthController::class)
    ->prefix('v1/auth')
    ->group(function ()
    {
        Route::post('/reg', 'register');
        Route::post('/login', 'login');
    });

