<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    /**
     * UserNotificationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // when a user wants to fetch all the unread notifications
    public function index(User $user)
    {
        return auth()->user()->unreadNotifications;
    }

    // when a user wants to delete all of their notifications
    public function destroy(User $user, $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
