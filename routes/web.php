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

Route::get('/', array(
    'as' => 'index',
    'uses' => 'PageController@index'
));

// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Authentication Routes...
Auth::routes();

Route::get('/app', 'IndexController@getIndex')->name('app')->middleware('auth.app');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::post('login', 'IndexController@postLogin')->name('voyager.logout');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('voyager.login');
});

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::any('logout', 'IndexController@logout')->name('app.logout');