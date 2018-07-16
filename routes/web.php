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

Route::get('/', 'BlogController@home');

Route::get('/post/create', 'BlogController@createPost');
Route::post('/post/create', 'BlogController@submitPost');
Route::get('/post/{id}', 'BlogController@viewPost');
Route::get('/post/edit/{id}', 'BlogController@editPost');
Route::post('/post/edit/{id}', 'BlogController@updatePost');
Route::get('/posts', 'BlogController@posts');
Route::get('/ajax/getTags', 'AjaxController@getTags');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@home')->name('profile');
