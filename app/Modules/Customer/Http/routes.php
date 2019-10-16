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
	// 产品列表
	Route::get('my_customer', ['as'=>'my_customer', 'uses'=>'CustomerController@myCustomer']);
});