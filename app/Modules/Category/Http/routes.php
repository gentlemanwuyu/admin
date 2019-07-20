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
	Route::get('index', ['as'=>'index', 'uses'=>'CategoryController@index']);

	// 产品分类树
	Route::get('category_tree/{type}', ['as'=>'category_tree', 'uses'=>'CategoryController@categoryTree']);

	// 添加/修改分类页面
	Route::get('create_or_update_category_page', ['as'=>'create_or_update_category_page', 'uses'=>'CategoryController@createOrUpdateCategoryPage']);

	// 添加/修改分类
	Route::post('create_or_update_category', ['as'=>'create_or_update_category', 'uses'=>'CategoryController@createOrUpdateCategory']);

	// 删除分类
	Route::post('delete_category', ['as'=>'delete_category', 'uses'=>'CategoryController@deleteCategory']);
});