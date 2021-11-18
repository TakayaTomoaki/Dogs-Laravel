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

Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@add')->name('home');
    Route::post('/', 'HomeController@index')->name('homeIndex');
});

Route::group(['prefix' => 'mypage', 'middleware' => 'auth'], function () {
    Route::get('/{user_id}', 'MypageController@add')->name('mypage');
    Route::get('/profile/create', 'MypageController@create')->name('create');
    Route::post('/profile/create', 'MypageController@store')
    ->name('store')->middleware('optimizeImages');
    Route::get('/profile/edit/{user_id}', 'MypageController@edit')->name('edit');
    Route::post('/profile/edit/{user_id}', 'MypageController@update')
    ->name('update')->middleware('optimizeImages');
    Route::get('/follower/{user_id}', 'MypageController@follow')->name('follower');
    Route::get('/receiver/{user_id}', 'MypageController@receive')->name('receiver');
    Route::get('/nice/{user_id}', 'NiceController@index')->name('nicer');
});

Route::group(['prefix' => 'share', 'middleware' => 'auth'], function () {
    Route::post('/', 'ShareController@store')
  ->name('share')->middleware('optimizeImages');
    Route::post('/delete', 'ShareController@delete')->name('share_delete');
});

Route::group(['prefix' => 'comment', 'middleware' => 'auth'], function () {
    Route::get('/{id}', 'CommentController@add')->name('comment');
    Route::post('/{id}', 'CommentController@store')->name('comment_store');
    Route::post('/delete/{id}', 'CommentController@delete')->name('comment_delete');
});

Route::group(['prefix' => 'search', 'middleware' => 'auth'], function () {
    Route::get('/', 'SearchController@add')->name('search');
});

Route::group(['prefix' => 'setup', 'middleware' => 'auth'], function () {
    Route::get('/{user_id}', 'SetupController@add')->name('setup');
    Route::get('/user/{user_id}', 'SetupController@edit')->name('user');
    Route::post('/user/{user_id}', 'SetupController@update')->name('user_setup');
    Route::get('/account/{user_id}', 'SetupController@handle')->name('account');
});

Route::group(['prefix' => '', 'middleware' => 'auth'], function () {
    Route::get('/nice', 'NiceController@store')->name('nice');
    Route::get('/unlock', 'NiceController@delete')->name('unlock');
    Route::post('/follow/{user_id}', 'FollowController@store')->name('follow');
    Route::post('/unfollow/{user_id}', 'FollowController@delete')->name('unfollow');
    Route::post('/like', 'LikeController@store')->name('like');
    Route::post('/unlike', 'LikeController@delete')->name('unlike');
});
