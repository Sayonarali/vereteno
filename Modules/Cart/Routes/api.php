<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\CartController;

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

Route::controller(CartController::class)
    ->prefix('cart')
    ->group(function () {
        Route::get('/{id}', 'show');
        Route::patch('/{id}', 'update');
        Route::patch('/{id}/remove', 'removeItem');
        Route::delete('/{id}', 'empty');
    });
