<?php
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('bindex');
});
// redirect home to index
Route::redirect('/home', '/index');


Route::get('/user/is-guest', 'UserController@isGuest');

Route::get('/user/get-user-name', 'UserController@getUserName');



Route::get('/', 'SiteController@index')->name('index');
Route::get('/index', 'SiteController@index')->name('index');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/products',[ProductsController::class, 'getProductById']);


// Route::get('/login', 'Auth\LoginController@login')->name('login');

// Password
Route::get('/home/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('reset');

Route::post('/home/password/update', 'Auth\ResetPasswordController@reset')->name('home.password.update');

// Cart
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart-add', 'CartController@addCartItem')->name('cart-add');
    Route::delete('/cart/{cart_item_id}/delete', 'CartController@removeCartItme')->name('cart-remove');
});

Route::get('{any}', function () { // 設定請求最後導向 vue的進入點
    return view('index');
})->where('any','.*');

