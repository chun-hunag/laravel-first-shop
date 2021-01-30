<?php
use App\User;
use App\Product;
use App\Http\Controllers\ProductsController;
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

Route::get('/user/is-guest', 'UserController@isGuest');

Route::get('/user/get-user-name', 'UserController@getUserName');



Route::get('/', 'SiteController@index')->name('index');
Route::get('/index', 'SiteController@index')->name('index');



Route::get('/welcone', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/{id}',[ProductsController::class, 'getProductById']);

// Route::get('/login', 'Auth\LoginController@login')->name('login');


Route::get('/home/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('reset');

Route::post('/home/password/update', 'Auth\ResetPasswordController@reset')->name('home.password.update');


Route::get('{any}', function () {
    return view('site.index');
})->where('any','.*');
