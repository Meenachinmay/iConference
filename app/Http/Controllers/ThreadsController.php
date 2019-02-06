<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    /**
     * ThreadsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }



    public function index()
    {
        $threads = Thread::latest()->get();

        return view('threads.index', compact('threads'));
    }



    public function create()
    {
        return view('threads.create');
    }


    public function store(Request $request)
    {
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect($thread->path());
    }



    public function show($channelId, Thread $thread)
    {
        // showing a thread
        return view ('threads.show', compact('thread'));
    }



    public function edit(Thread $thread)
    {
        //
    }



    public function update(Request $request, Thread $thread)
    {
        //
    }



    public function destroy(Thread $thread)
    {
        //
    }
}
