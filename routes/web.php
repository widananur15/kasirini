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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view/input-product', 'ProductController@viewAddProduct');
Route::get('/view/input-level-price', 'ProductController@viewAddLevelPrice');
Route::get('/view/input-sell-price-product', 'ProductController@viewAddSellPriceProduct');
Route::get('/view/input-pos', 'ProductController@viewAddPos');
