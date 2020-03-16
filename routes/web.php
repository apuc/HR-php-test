<?php

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

use App\Http\Controllers\OrdersController;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/weather', 'HomeController@weather')->name('weather');

Route::get('/products', 'ProductsController@index')->name('products');
Route::post('/product/{id}/price', 'ProductsController@editPrice')->name('products.price');

Route::resource('/order','OrdersController');
