<?php

namespace App\Http\Controllers;


use App\Http\Requests\ReplyRequest;
use App\Inspection\Spam;
use App\Thread;
use App\Channel;
use App\Reply;
use Auth;

class RepliesController extends Controller
{

    // creating auth middleware
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    // index method to handle the request for all the replies for a single thread
    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }


    // store a reply to a thread
    public function store(Channel $channel, Thread $thread, ReplyRequest $request, Spam $spam)
    {

        // detecting for spam keywords in reply
        $spam->detect(request('body'));

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        // for vue js ajax request
        if($request->expectsJson()){
            return $reply->load('owner');
        }

        return back()->with('flash', 'New reply added.');

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
