<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TODO: あとで消す（ユーザ登録SQL作成）
//if (app()->isLocal()) {
//    Route::get('/makepassword', ['as' => 'makepassword', 'uses' => 'MakePasswordController@index']);
//}

Route::group(['as' => 'menu::'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'MenuController@index']);
});

Route::group(['as' => 'schedule::'], function() {
    Route::get('/schedule/', ['as' => 'index', 'uses' => 'ScheduleController@listed']);
    Route::get('/schedule/listed', ['as' => 'listed', 'uses' => 'ScheduleController@listed']);
    Route::get('/schedule/input', ['as' => 'input', 'uses' => 'ScheduleController@input']);
    Route::post('/schedule/edit', ['as' => 'edit', 'uses' => 'ScheduleController@edit']);
    Route::post('/schedule/confirm', ['as' => 'confirm', 'uses' => 'ScheduleController@confirm']);
    Route::post('/schedule/complete', ['as' => 'complete', 'uses' => 'ScheduleController@complete']);
});


/**
 * 認証権限まわり
 * ログインとログアウトのみを有効としたかったので下記のように記載
 * 新規登録、パスワード変更を有効とする場合は下記コメントを外す
 *
 * @see \Illuminate\Routing\Router::auth()
 */

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
