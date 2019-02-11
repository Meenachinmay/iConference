<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Http\Requests\ReplyRequest;
use Illuminate\Http\Request;
use App\Thread;
use App\Channel;
use App\Reply;
use Auth;

class RepliesController extends Controller
{

    // add a reply to a particular thread
    /**
     * RepliesController constructor.
     */

    // creating auth middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // store a reply to a thread
    public function store(Thread $thread, ReplyRequest $request)
    {

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $thread->id,
            'body' => $request->body
        ]);

        return back()->with('flash', "New reply added.");

    }


    // method to delete a reply only by authenticated user
    public function destroy(Reply $reply)
    {
        // if user is authorized then he can delete the reply ( Authorization using policy)
        $this->authorize('update', $reply);

//        $favorites = Favorite::where('favorited_id', $reply->id)->get();

        // delete it and back
        $reply->delete();

        return back()->with('flash', 'Reply deleted successfully');
    }
}
