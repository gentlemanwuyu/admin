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

Route::group(['prefix' => 'department', 'as' => 'department.'], function() {
	// 部门结构图页面
	Route::get('chart', ['as'=>'chart', 'uses'=>'DepartmentController@chart']);

	// 获取部门树
	Route::get('get_tree', ['as'=>'get_tree', 'uses'=>'DepartmentController@getTree']);

	// 添加子部门
	Route::post('add', ['as'=>'add', 'uses'=>'DepartmentController@add']);

	// 修改部门信息
	Route::post('update', ['as'=>'update', 'uses'=>'DepartmentController@update']);

	// 删除部门
	Route::post('delete', ['as'=>'delete', 'uses'=>'DepartmentController@delete']);
});