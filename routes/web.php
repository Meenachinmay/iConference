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


Route::prefix('threads')->group(function (){
    // thread index
    Route::get('/', 'ThreadsController@index')->name('threadIndex');
    // thread create
    Route::get('create', 'ThreadsController@create')->name('threadCreate');
    // thread create
    Route::post('creatThread', 'ThreadsController@store')->name('threadCreateThread');
    // thread show
    Route::get('{channel}/{thread}', 'ThreadsController@show')->name('threadShow');
    // thread delete
    Route::delete('{channel}/{thread}', 'ThreadsController@destroy')->name('deleteThisThread');
    // adding reply to a thread route
    Route::post('{channel}/{thread}/replies', 'RepliesController@store')->name('addNewReply');
    // fetching all the replies for a single thread
    Route::get('{channel}/{thread}/replies', 'RepliesController@index')->name('getAllRepliesForAThread');
    // viewing all threads of a channel
    Route::get('{channel}', 'ThreadsController@index')->name('allThreads_of_a_channel');
    // end point to subscribe a thread when user click subscribe button
    Route::post('{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->name('subscribeToThisThread');
    // delete user subscriptions for threads
    Route::delete('{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->name('deleteSubscriptionToThisThread');
});


// route to delete a reply
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('deleteReply');
// route to update a reply
Route::patch('/replies/{reply}', 'RepliesController@update')->name('updateReply');
// favorites reply route
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('addFavoriteReply');
// delete a like from favorites table
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('deleteFavoriteReply');



// User Profile routes
Route::get('/profile/{user}', 'ProfilesController@show')->name('userProfile');
// User Notifications delete (MarkAsRead)
Route::delete('/profile/{user}/notifications/{notification}', 'UserNotificationsController@destroy')->name('deleteUserNotifications');
// get all the user's notifications
Route::get('/profile/{user}/notifications', 'UserNotificationsController@index')->name('getAllUserNotifications');
