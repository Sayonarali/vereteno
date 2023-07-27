<?php

use App\Admin\Controllers\AttributeController;
use App\Admin\Controllers\CartItemController;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\ColorController;
use App\Admin\Controllers\DiscountController;
use App\Admin\Controllers\MaterialController;
use App\Admin\Controllers\OrderAddressController;
use App\Admin\Controllers\OrderController;
use App\Admin\Controllers\ProductController;
use App\Admin\Controllers\SizeController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\VendorCodeController;
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
    $router->resource('size', SizeController::class);
    $router->resource('vendor-code', VendorCodeController::class);
    $router->resource('order', OrderController::class);
    $router->resource('order-address', OrderAddressController::class);
    $router->resource('user', UserController::class);
    $router->resource('attribute', AttributeController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('discount', DiscountController::class);
    $router->resource('cart-item', CartItemController::class);
});
