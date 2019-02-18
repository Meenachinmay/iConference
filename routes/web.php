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


// thread index
Route::get('threads', 'ThreadsController@index')->name('threadIndex');

// thread create
Route::get('threads/create', 'ThreadsController@create')->name('threadCreate');

// thread createPost
Route::post('threads/creatThread', 'ThreadsController@store')->name('threadCreateThread');

// thread show
Route::get('threads/{channel}/{thread}', 'ThreadsController@show')->name('threadShow');

// thread show
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy')->name('deleteThisThread');



// adding reply to a thread route
Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store')->name('addNewReply');

// fetching all the replies for a single thread
Route::get('threads/{channel}/{thread}/replies', 'RepliesController@index')->name('getAllRepliesForAThread');

// route to delete a reply
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('deleteReply');

// route to update a reply
Route::patch('/replies/{reply}', 'RepliesController@update')->name('updateReply');


// viewing all threads of a channel
Route::get('threads/{channel}', 'ThreadsController@index')->name('allThreads_of_a_channel');


// favorites reply route
Route::post('replies/{reply}/favorites', 'FavoritesController@store')->name('addFavoriteReply');

// delete a like from favorites table
Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy')->name('deleteFavoriteReply');

// User Profile routes
Route::get('/profile/{user}', 'ProfilesController@show')->name('userProfile');


// end point to subscribe a thread when user click subscribe button
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->name('subscribeToThisThread');

// delete user subscriptions for threads
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->name('deleteSubscriptionToThisThread');

// User Notifications delete (MarkAsRead)
Route::delete('/profile/{user}/notifications/{notification}', 'UserNotificationsController@destroy')->name('deleteUserNotifications');

// get all the user's notifications
Route::get('/profile/{user}/notifications', 'UserNotificationsController@index')->name('getAllUserNotifications');
