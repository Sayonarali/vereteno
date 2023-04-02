<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::controller(ProductController::class)
    ->group(function ()
    {
       Route::get('products', 'index');
       Route::get('product/{id}', 'show');
       Route::post('product', 'create');
       Route::put('product/{id}', 'update');
       Route::patch('product/{id}', 'update');
       Route::delete('product/{id}', 'delete');
    });

Route::controller(CategoryController::class)
    ->group(function ()
    {
        Route::get('categories', 'index');
        Route::get('category/{id}', 'show');
        Route::post('category', 'create');
        Route::put('category/{id}', 'update');
        Route::patch('category/{id}', 'update');
        Route::delete('category/{id}', 'delete');
    });
