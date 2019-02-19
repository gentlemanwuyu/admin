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

// Department控制器
Route::group(['prefix' => 'department', 'as' => 'department.'], function() {
	// 部门结构图页面
	Route::get('chart', ['as'=>'chart', 'middleware'=>['permission:department_chart'], 'uses'=>'DepartmentController@chart']);

	// 获取部门树
	Route::get('get_tree', ['as'=>'get_tree', 'uses'=>'DepartmentController@getTree']);

	// 添加子部门
	Route::post('add', ['as'=>'add', 'middleware'=>['permission:add_department'], 'uses'=>'DepartmentController@add']);

	// 修改部门信息
	Route::post('update', ['as'=>'update', 'middleware'=>['permission:edit_department'], 'uses'=>'DepartmentController@update']);

	// 删除部门
	Route::post('delete', ['as'=>'delete', 'middleware'=>['permission:delete_department'], 'uses'=>'DepartmentController@delete']);

	// 拖动部门
	Route::post('drag', ['as'=>'drag', 'middleware'=>['permission:drag_department'], 'uses'=>'DepartmentController@drag']);
});

// Position控制器
Route::group(['prefix' => 'position', 'as' => 'position.'], function() {
	// 职位管理页面
	Route::get('index', ['as'=>'index', 'uses'=>'PositionController@index']);
});