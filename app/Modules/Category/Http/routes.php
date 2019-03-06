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

// Category控制器
Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
	// 产品分类树
	Route::get('product_category_tree', ['as'=>'product_category_tree', 'uses'=>'CategoryController@productCategoryTree']);
});