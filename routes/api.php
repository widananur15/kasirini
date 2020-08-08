<?php

use Illuminate\Http\Request;

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

});

Route::post("/add-product", 'ProductController@addProduct');
Route::post("/add-level-price-product", 'ProductController@addLevelPriceProduct');
Route::post("/add-sell-price-product", 'ProductController@addSellPriceProduct');
Route::get("/get-level-price-product-list", 'ProductController@getLevelPriceProduct');
Route::get("/get-product-list", 'ProductController@getProductList');
Route::post("/get-sell-price-product", 'ProductController@getSellPriceProductListByIndex');
