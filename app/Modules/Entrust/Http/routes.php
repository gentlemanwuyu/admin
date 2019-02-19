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

// permission控制器
Route::group(['prefix' => 'permission', 'as' => 'permission.'], function() {
	// 权限列表
	Route::get('list', ['as'=>'list', 'middleware'=>['permission:permission_list'], 'uses'=>'PermissionController@getList']);

	// 创建/修改页面
	Route::get('create_or_update_page', ['as'=>'create_or_update_page', 'middleware'=>['permission:add_permission|edit_permission'], 'uses'=>'PermissionController@createOrUpdatePage']);

	// 创建/修改权限
	Route::post('create_or_update', ['as'=>'create_or_update', 'middleware'=>['permission:add_permission|edit_permission'], 'uses'=>'PermissionController@createOrUpdate']);

	// 删除权限
	Route::post('delete', ['as'=>'delete', 'middleware'=>['permission:delete_permission'], 'uses'=>'PermissionController@delete']);
});

// role控制器
Route::group(['prefix' => 'role', 'as' => 'role.'], function() {
	// 权限列表
	Route::get('list', ['as'=>'list', 'middleware'=>['permission:role_list'], 'uses'=>'RoleController@getList']);
	// 创建/修改页面
	Route::get('create_or_update_page', ['as'=>'create_or_update_page', 'middleware'=>['permission:add_role|edit_role'], 'uses'=>'RoleController@createOrUpdatePage']);

	// 创建/修改角色
	Route::post('create_or_update', ['as'=>'create_or_update', 'middleware'=>['permission:add_role|edit_role'], 'uses'=>'RoleController@createOrUpdate']);

	// 删除角色
	Route::post('delete', ['as'=>'delete', 'middleware'=>['permission:delete_role'], 'uses'=>'RoleController@delete']);
});