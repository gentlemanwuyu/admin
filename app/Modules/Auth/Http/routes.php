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

// 登陆页面，不需要auth中间件
Route::get('login', ['as'=>'login', 'uses'=>'AuthController@login']);
Route::post('sign_in', ['as'=>'sign_in', 'uses'=>'AuthController@signIn']);

// 首页
Route::get('/', ['middleware' => ['auth'], 'as'=>'index', 'uses'=>'IndexController@index']);

Route::group(['middleware'=>['auth'], 'prefix'=>'auth', 'as'=>'auth::'], function (){
    // AuthController
    Route::group(['prefix'=>'auth', 'as'=>'auth.'], function (){
        // 退出
        Route::get('login', ['as'=>'sign_out', 'uses'=>'AuthController@signOut']);

        // 修改密码页面
        Route::get('modify_password_page', ['as'=>'modify_password_page', 'uses'=>'AuthController@modifyPasswordPage']);

        // 修改密码
        Route::post('modify_password', ['as'=>'modify_password', 'uses'=>'AuthController@modifyPassword']);

        // 用户列表
        Route::get('user_list', ['as'=>'user_list', 'middleware'=>['permission:user_list'], 'uses'=>'AuthController@userList']);

        // 添加/修改用户页面
        Route::get('create_or_update_user_page', ['as'=>'create_or_update_user_page', 'middleware'=>['permission:add_user|edit_user'], 'uses'=>'AuthController@createOrUpdateUserPage']);

        // 添加/修改用户
        Route::post('create_or_update_user', ['as'=>'create_or_update_user', 'middleware'=>['permission:add_user|edit_user'], 'uses'=>'AuthController@createOrUpdateUser']);

        // 删除用户
        Route::post('delete_user', ['as'=>'delete_user', 'middleware'=>['permission:delete_user'], 'uses'=>'AuthController@deleteUser']);
    });

    // IndexController
    Route::group(['prefix'=>'index', 'as'=>'index.'], function (){

    });
});
