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

Route::get('/', 'SiteController@index')->name('index');

Route::get('/welcone', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/test', function () {
    return view('site.test');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/{id}/show',[ProductsController::class, 'show']);

// Route::get('/login', 'Auth\LoginController@login')->name('login');


Route::get('/home/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('reset');

Route::post('/home/password/update', 'Auth\ResetPasswordController@reset')->name('home.password.update');

