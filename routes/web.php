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

Route::get('/','social_start@index');
Route::resource('social_start','social_start');
Auth::routes();
Route::resource('friends','friends');
Route::resource('comments','comments2');
Route::resource('profiles','profiles');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('search', 'search@index')->name('search');
Route::get('wall','wall@index')->name('wall');
Route::resource('posts','posts2');
