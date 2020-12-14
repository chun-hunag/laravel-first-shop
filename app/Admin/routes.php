<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('products', ProductController::class);
    $router->resource('product-skus', ProductSkuController::class);
    $router->resource('carts', CartController::class);
    $router->resource('cart-items', CartItemController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('order-items', OrderItemsController::class);
});
