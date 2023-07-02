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
    ->prefix('category')
    ->group(function ()
    {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::patch('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
