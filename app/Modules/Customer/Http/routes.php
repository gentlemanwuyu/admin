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

	// 黑名单
	Route::get('black_list', ['as'=>'black_list', 'uses'=>'CustomerController@blackList']);

	// 添加/修改客户页面
	Route::get('create_or_update_customer_page', ['as'=>'create_or_update_customer_page', 'uses'=>'CustomerController@createOrUpdateCustomerPage']);

	// 添加/修改客户
	Route::post('create_or_update_customer', ['as'=>'create_or_update_customer', 'uses'=>'CustomerController@createOrUpdateCustomer']);

	// 删除客户
	Route::post('delete_customer', ['as'=>'delete_customer', 'uses'=>'CustomerController@deleteCustomer']);

	// 拉黑客户
	Route::post('black_customer', ['as'=>'black_customer', 'uses'=>'CustomerController@blackCustomer']);

	// 释放客户
	Route::post('release_customer', ['as'=>'release_customer', 'uses'=>'CustomerController@releaseCustomer']);

	// 客户池
	Route::get('customer_pool', ['as'=>'customer_pool', 'uses'=>'CustomerController@customerPool']);

	// 付款方式审核
	Route::get('payment_method_application_list', ['as'=>'payment_method_application_list', 'uses'=>'CustomerController@paymentMethodApplicationList']);

	// 分配客户页面
	Route::get('assign_customer_page', ['as'=>'assign_customer_page', 'uses'=>'CustomerController@assignCustomerPage']);

	// 分配客户
	Route::post('assign_customer', ['as'=>'assign_customer', 'uses'=>'CustomerController@assignCustomer']);

	// 放弃客户
	Route::post('abandon_customer', ['as'=>'abandon_customer', 'uses'=>'CustomerController@abandonCustomer']);

	// 创建/修改付款方式申请单的页面
	Route::get('create_or_update_payment_method_application_page', ['as'=>'create_or_update_payment_method_application_page', 'uses'=>'CustomerController@createOrUpdatePaymentMethodApplicationPage']);

	// 创建/修改付款方式申请单
	Route::post('create_or_update_payment_method_application', ['as'=>'create_or_update_payment_method_application', 'uses'=>'CustomerController@createOrUpdatePaymentMethodApplication']);
});