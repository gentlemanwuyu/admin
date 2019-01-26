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
});