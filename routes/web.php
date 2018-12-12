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

Route::get('/', 'MainController@home');
Route::get('/carrito', 'ShoppingCartController@index');
Route::get('/payment/store', 'PaymentController@store');

Auth::routes();

Route::resource('products', 'ProductController');
Route::resource('in_shopping_carts', 'InShoppingCartController', ['only' => ['store','destroy']]);
Route::resource('compras', 'ShoppingCartController', ['only' => ['show']]);
Route::resource('orders', 'OrderController',['only' => ['index','update']]);
Route::get('/home', 'HomeController@index');
