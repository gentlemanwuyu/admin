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

// Customer控制器
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function() {
	// 我的客户
	Route::get('my_customer', ['as'=>'my_customer', 'uses'=>'CustomerController@myCustomer']);

	// 添加/修改客户页面
	Route::get('create_or_update_customer_page', ['as'=>'create_or_update_customer_page', 'uses'=>'CustomerController@createOrUpdateCustomerPage']);

	// 添加/修改客户
	Route::post('create_or_update_customer', ['as'=>'create_or_update_customer', 'uses'=>'CustomerController@createOrUpdateCustomer']);

	// 删除客户
	Route::post('delete_customer', ['as'=>'delete_customer', 'uses'=>'CustomerController@deleteCustomer']);
});