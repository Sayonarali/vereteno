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
    ->prefix('v1/cart-item')
    ->group(function () {
        Route::get('/', 'show');
        Route::patch('/{cartItem}', 'update');
        Route::delete('/', 'empty');

        Route::post('/', 'create');
        Route::delete('/{cartItem}', 'removeItem');
    });

