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

// Goods控制器
Route::group(['prefix' => 'goods', 'as' => 'goods.'], function() {
	// 产品列表
	Route::get('list', ['as'=>'list', 'uses'=>'GoodsController@getList']);

	// 选择产品
	Route::get('choose_product_page', ['as'=>'choose_product_page', 'uses'=>'GoodsController@chooseProductPage']);

	// 请求产品数据接口
	Route::post('get_products', ['as'=>'get_products', 'uses'=>'GoodsController@getProducts']);

	// 添加/修改单品页面
	Route::get('create_or_update_single_page', ['as'=>'create_or_update_single_page', 'uses'=>'GoodsController@createOrUpdateSinglePage']);

	// 添加/修改单品
	Route::post('create_or_update_single', ['as'=>'create_or_update_single', 'uses'=>'GoodsController@createOrUpdateSingle']);
});