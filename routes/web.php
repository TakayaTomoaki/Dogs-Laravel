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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@add')->name('home');

Route::get('/mypage', 'MypageController@add')->name('mypage');
Route::get('/mypage/profile', 'MypageController@edit')->name('profile');
Route::post('/mypage/profile', 'MypageController@update')->name('dogs_profile');
Route::post('/mypage/profile/create', 'MypageController@create')->name('create');
Route::get('/mypage/profile/create', function () {
    return view('mypage.create');
});
Route::get('/mypage/delete', 'MypageController@delete')->name('delete');


Route::get('/search', 'SearchController@add')->name('search');

Route::get('/notice', 'NoticeController@add')->name('notice');

Route::get('/messages', 'MessagesController@add')->name('messages');

Route::get('/setup', 'SetupController@add')->name('setup');
Route::get('/setup/user', 'SetupController@edit')->name('user');
Route::post('/setup/user', 'SetupController@update')->name('user_setup');
Route::get('/setup/account', 'SetupController@handle')->name('account');
