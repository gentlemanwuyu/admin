<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Product控制器
Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
	// 产品列表
	Route::get('list', ['as'=>'list', 'uses'=>'ProductController@getList']);
});