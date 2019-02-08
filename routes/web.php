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

// user dashboard route
Route::get('home', 'HomeController@index')->name('home');

// modified home route for temperary uses
//Route::get('home', 'ThreadsController@index')->name('home');

// thread index
Route::get('threads', 'ThreadsController@index')->name('threadIndex');

// thread create
Route::get('threads/create', 'ThreadsController@create')->name('threadCreate');

// thread createPost
Route::post('threads/creatThread', 'ThreadsController@store')->name('threadCreateThread');

// thread show
Route::get('threads/{channel}/{thread}', 'ThreadsController@show')->name('threadShow');

// adding reply to a thread route
Route::post('threads/{thread}/replies', 'RepliesController@store')->name('addNewReply');


// viewing all threads of a channel
Route::get('threads/{channel}', 'ThreadsController@index')->name('allThreads_of_a_channel');


// favorites reply route
Route::post('replies/{reply}/favorites', 'FavoritesController@store')->name('addFavoriteReply');
