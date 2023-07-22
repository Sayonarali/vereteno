<?php

use Illuminate\Support\Facades\Route;
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
    ->prefix('v1/product')
    ->group(function ()
    {
        Route::get('/', 'index');
        Route::get('/{product}', 'show');
        Route::get('/list/attributes', 'getAttributes');
        Route::get('/list/colors', 'getColors');
        Route::get('/list/materials', 'getMaterials');
        Route::get('/list/sizes', 'getSizes');

//        Route::post('/', 'create');
//        Route::put('/{product}', 'update');
//        Route::patch('/{product}', 'update');
//        Route::delete('/{product}', 'delete');
    });
