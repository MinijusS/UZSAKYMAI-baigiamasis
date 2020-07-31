<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('orders', 'OrderController');
//Route::post('/orders/{order}/done', 'OrderController@done')->name('orders.done');
//Route::post('/orders/{order}/revert', 'OrderController@revert')->name('orders.revert');
Route::resource('products', 'ProductController');
Route::resource('categories', 'CategoryController');
