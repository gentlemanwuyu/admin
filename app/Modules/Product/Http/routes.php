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

	// 产品列表
	Route::get('create_or_update_product_page', ['as'=>'create_or_update_product_page', 'uses'=>'ProductController@createOrUpdateProductPage']);

	// 图片上传
	Route::post('upload', ['as'=>'upload', 'uses'=>'ProductController@upload']);
});