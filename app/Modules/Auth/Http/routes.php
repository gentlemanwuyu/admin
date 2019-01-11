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
