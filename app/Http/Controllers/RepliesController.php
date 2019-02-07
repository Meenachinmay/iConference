<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use Illuminate\Http\Request;
use App\Thread;
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
//        $thread->addReply([
//
//            'body' => request(['body']),
//
//            'user_id' => Auth::id(),
//        ]);

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $thread->id,
            'body' => $request->body
        ]);

        return back();

    }
}
