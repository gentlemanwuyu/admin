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

// Supplier控制器
Route::group(['prefix' => 'supplier', 'as' => 'supplier.'], function() {
	// 供应商列表
	Route::get('list', ['as'=>'list', 'uses'=>'SupplierController@getList']);

	// 添加/修改供应商页面
	Route::get('create_or_update_supplier_page', ['as'=>'create_or_update_supplier_page', 'uses'=>'SupplierController@createOrUpdateSupplierPage']);

	// 添加/修改供应商
	Route::post('create_or_update_supplier', ['as'=>'create_or_update_supplier', 'uses'=>'SupplierController@createOrUpdateSupplier']);

	// 拉黑
	Route::post('black_supplier', ['as'=>'black_supplier', 'uses'=>'SupplierController@blackSupplier']);

	// 释放
	Route::post('release_supplier', ['as'=>'release_supplier', 'uses'=>'SupplierController@releaseSupplier']);

	// 删除
	Route::post('delete_supplier', ['as'=>'delete_supplier', 'uses'=>'SupplierController@deleteSupplier']);

	// 供应商详情
	Route::get('detail/{id}', ['as'=>'detail', 'uses'=>'SupplierController@detail']);
});