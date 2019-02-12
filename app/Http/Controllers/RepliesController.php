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



    // update a reply here (with vuejs)
    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(\request(['body']));

        return back()->with('flash', 'Reply has been updated.');
    }



    // method to delete a reply only by authenticated user
    public function destroy(Reply $reply)
    {
        // if user is authorized then he can delete the reply ( Authorization using policy)
        $this->authorize('update', $reply);

        // delete it and back
        $reply->delete();

        // if a ajax request has been placed
        if(request()->expectsJson()){
           return response(['status' => 'Reply deleted']);
        }

        return back()->with('flash', 'Reply deleted successfully');
    }

}
