<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\User;
use App\Http\Requests\ThreadRequest;
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


    /**
     * @param Channel $channel
     * @param ThreadFilter $filters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {

        if ($channel->exists) {

            // if channel id exist then getting all the threads of that channel for show
            $threads = $channel->threads()->latest();

        } else {

            // else getting all the threads of that channel
            $threads = Thread::latest();
        }

        // getting the filtered results
        $threads = $threads->filter($filters)->get();

        return view('threads.index', compact('threads'));
    }



    public function create()
    {
        return view('threads.create');
    }


    public function store(ThreadRequest $request)
    {


        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect()->route('threadShow');
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
