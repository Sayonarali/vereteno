<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderController;

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

Route::controller(OrderController::class)
    ->middleware('auth:api')
    ->prefix('v1/order')
    ->group(function () {
        Route::get('/', 'show');
        Route::post('/', 'create');
        Route::post('/custom', 'custom');
        Route::patch('/{id}', 'updateOrderStatus');
    });
