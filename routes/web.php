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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UsersController@index')->name('users');
Route::post('/users/create', 'UsersController@create')->name('users.create.post');
Route::get('/users/create', 'UsersController@create')->name('users.create.view');
Route::get('/users/{user}', 'UsersController@view')->name('users.view');
Route::get('/users/edit/{user}', 'UsersController@edit')->name('users.edit');
Route::post('/users/edit/{user}', 'UsersController@edit')->name('users.edit.post');
Route::get('/users/delete/{user}', 'UsersController@delete')->name('users.delete');
Route::get('/profile', 'ProfileController@view')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/edit', 'ProfileController@edit')->name('profile.edit.post');
