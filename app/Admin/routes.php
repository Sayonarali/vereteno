<?php

use App\Admin\Controllers\ColorController;
use App\Admin\Controllers\MaterialController;
use App\Admin\Controllers\ProductController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('product', ProductController::class);
    $router->resource('material', MaterialController::class);
    $router->resource('color', ColorController::class);
});
