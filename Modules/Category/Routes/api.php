<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

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
