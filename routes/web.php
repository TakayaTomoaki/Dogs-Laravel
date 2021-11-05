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
Route::post('/home', 'HomeController@index')->name('homeIndex');
Route::post('/share', 'ShareController@store')->name('share');

Route::get('/mypage/{user_id}', 'MypageController@add')->name('mypage');
Route::post('/mypage/{user_id}', 'ShareController@delete')->name('share_delete');
Route::get('/mypage/profile/create', 'MypageController@create')->name('create');
Route::post('/mypage/profile/create', 'MypageController@store')->name('store');
Route::get('/mypage/profile/edit/{user_id}', 'MypageController@edit')->name('edit');
Route::post('/mypage/profile/edit/{user_id}', 'MypageController@update')->name('update');
Route::get('/mypage/follower/{user_id}', 'MypageController@follow')->name('follower');
Route::get('/mypage/receiver/{user_id}', 'MypageController@receive')->name('receiver');
Route::get('/mypage/nice/{user_id}', 'NiceController@index')->name('nicer');


Route::get('/share/{id}', 'CommentController@add')->name('comment');
Route::post('/share/{id}', 'CommentController@store')->name('comment_store');

Route::get('/search', 'SearchController@add')->name('search');

Route::post('/follow/{user_id}', 'FollowController@store')->name('follow');
Route::post('/unfollow/{user_id}', 'FollowController@delete')->name('unfollow');

Route::get('/notice/{user_id}', 'NoticeController@add')->name('notice');

Route::get('/setup/{user_id}', 'SetupController@add')->name('setup');
Route::get('/setup/user/{user_id}', 'SetupController@edit')->name('user');
Route::post('/setup/user/{user_id}', 'SetupController@update')->name('user_setup');
Route::get('/setup/account/{user_id}', 'SetupController@handle')->name('account');

Route::post('/nice', 'NiceController@store')->name('nice');
Route::post('/unlock', 'NiceController@delete')->name('unlock');
