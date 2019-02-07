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

        // getting threads by applying filters if there is any
        $threads = $this->getThreads($channel, $filters);

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

        return redirect()->route('threadIndex');
    }



    public function show($channelId, Thread $thread)
    {
        // showing a thread ( also creating a pagination for replies when they will more than 10 in count)
        return view ('threads.show', [

            'thread' => $thread,
            'replies' => $thread->replies()->paginate(10),

        ]);
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

    /**
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {

            // if channel id exist then getting all the threads of that channel for show
            $threads->where('channel_id', $channel->id);

        }

        // getting the filtered results
        $threads = $threads->get();
        return $threads;
    }

}
