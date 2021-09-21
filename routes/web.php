<?php declare(strict_types=1);

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
Route::post('/home', 'ShareController@create')->name('share');

Route::get('/mypage/{user_id}', 'MypageController@add')->name('mypage');
Route::get('/mypage/profile/create', 'MypageController@create')->name('create');
Route::post('/mypage/profile/create', 'MypageController@store')->name('store');
Route::get('/mypage/profile/edit/{user_id}', 'MypageController@edit')->name('edit');
Route::post('/mypage/profile/edit/{user_id}', 'MypageController@update')->name('update');
Route::get('/mypage/delete/{user_id}', 'MypageController@delete')->name('delete');


Route::get('/search', 'SearchController@add')->name('search');

Route::get('/notice/{user_id}', 'NoticeController@add')->name('notice');

Route::get('/messages/{user_id}', 'MessagesController@add')->name('messages');

Route::get('/setup/{user_id}', 'SetupController@add')->name('setup');
Route::get('/setup/user/{user_id}', 'SetupController@edit')->name('user');
Route::post('/setup/user/{user_id}', 'SetupController@update')->name('user_setup');
Route::get('/setup/account/{user_id}', 'SetupController@handle')->name('account');
