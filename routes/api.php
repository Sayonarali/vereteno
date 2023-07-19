<?php

use App\Http\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    ->prefix('v1')
    ->prefix('auth')
    ->middleware('auth:api')
    ->group(function ()
    {
        Route::get('/by-token', 'authByToken');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
    });

Route::controller(AuthController::class)
    ->prefix('v1')
    ->prefix('auth')
    ->group(function ()
    {
        Route::post('/reg', 'register');
        Route::post('/login', 'login');
    });

Route::get('/v1/documentation', function() {
    return Storage::disk('public')->get('openapi.yaml');
});

