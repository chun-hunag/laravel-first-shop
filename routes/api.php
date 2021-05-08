<?php

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\ProductsController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});



// Product
Route::group([
    'middleware' => 'api',
    'prefix' => 'product'
], function ($router) {
    Route::get('/search',[ProductsController::class, 'search']);
    Route::get('/{id}','ProductsController@getProductById');
    
});

// Cart
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart-add', 'CartController@addCartItem')->name('cart-add');
    Route::delete('/cart/{cart_item_id}/delete', 'CartController@removeCartItme')->name('cart-remove');
});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
