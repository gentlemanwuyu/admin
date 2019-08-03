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

	// 添加/修改产品页面
	Route::get('create_or_update_product_page', ['as'=>'create_or_update_product_page', 'uses'=>'ProductController@createOrUpdateProductPage']);

	// 添加/修改产品
	Route::post('create_or_update_product', ['as'=>'create_or_update_product', 'uses'=>'ProductController@createOrUpdateProduct']);

	// 设置库存页面
	Route::get('set_inventory_page', ['as'=>'set_inventory_page', 'uses'=>'ProductController@setInventoryPage']);

	// 设置库存
	Route::post('set_inventory', ['as'=>'set_inventory', 'uses'=>'ProductController@setInventory']);

	// 图片上传
	Route::post('upload', ['as'=>'upload', 'uses'=>'ProductController@upload']);

	// 删除
	Route::post('delete_product', ['as'=>'delete_product', 'uses'=>'ProductController@deleteProduct']);

	// 产品详情
	Route::get('detail/{id}', ['as'=>'detail', 'uses'=>'ProductController@detail']);
});