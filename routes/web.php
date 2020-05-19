<?php

use Illuminate\Support\Facades\Route;

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

//Auth::routes();
#登入
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
#登出
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

#註冊
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

#忘記密碼
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//首頁
Route::get('/', function () {
    return view('index');
});
Route::get('index', function () {
    return redirect('/');
});



//新增單字
//Route::get('vocabularies/create}', 'ToeicsController@create')->name('toeic.create');

//送出新增單字
//Route::post('vocabularies/store}', 'ToeicsController@store')->name('toeic.store');

//秀出各階級及單字
Route::get('vocabularies/level/{level}', 'ToeicsController@level')->name('toeic.level');

//顯示要修改的單字
//Route::get('vocabularies/{id}', 'ToeicsController@edit')->name('toeic.edit');

//送出修改單字
//Route::patch('vocabularies/{id}', 'ToeicsController@update')->name('toeic.update');

//刪除單字
//Route::delete('vocabularies/{id}', 'ToeicsController@destory')->name('toeic.destory');

//搜尋單字
Route::get('search', 'ToeicsController@search')->name('toeic.search');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'],function(){
  //顯示每天單字
  Route::get('vocabularies', 'ToeicsController@index')->name('toeic.index');
  //秀出歷史單字
  Route::get('vocabularies/show/{date?}', 'ToeicsController@show')->name('toeic.show');
  //使用者設定頁面
  Route::get('setting', 'SettingsController@show')->name('Settings.show');
  //update使用者設定頁面
  Route::patch('setting', 'SettingsController@update')->name('Settings.update');

});
