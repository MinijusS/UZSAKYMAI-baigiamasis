<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/orders', 'ApiController@index')->name('orders.api.index');
Route::get('/products', 'ApiController@productIndex')->name('products.api.index');

Route::post('/orders/{order}/done', 'ApiController@done')->name('orders.api.done');
Route::post('/orders/{order}/revert', 'ApiController@revert')->name('orders.api.revert');
Route::post('/orders/{order}/cancel', 'ApiController@cancel')->name('orders.api.cancel');


Route::get('/order_create', 'ApiController@create')->name('orders.api.create');
