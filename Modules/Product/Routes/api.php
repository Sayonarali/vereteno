<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\CategoryController;
use Modules\Product\Http\Controllers\ProductController;

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

Route::controller(ProductController::class)
    ->middleware('auth:api')
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
    ->middleware('auth:api')
    ->group(function ()
    {
        Route::get('categories', 'index');
        Route::get('category/{id}', 'show');
        Route::post('category', 'create');
        Route::put('category/{id}', 'update');
        Route::patch('category/{id}', 'update');
        Route::delete('category/{id}', 'delete');
    });
