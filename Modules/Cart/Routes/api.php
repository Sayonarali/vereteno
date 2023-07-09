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
    ->middleware('auth:api')
    ->prefix('cart-item')
    ->group(function () {
        Route::get('/', 'show');
        Route::patch('/', 'update');
        Route::delete('/', 'empty');

        Route::post('/{product}', 'addItem');
        Route::delete('/{id}', 'removeItem');
    });

