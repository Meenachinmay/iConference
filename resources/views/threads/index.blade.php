@extends('layouts.app')

@section('content')
    <div class="container mt-3" style="max-width: 1240px;">
        <div class="row">

            <div class="col-md-2 mt-2" style="font-family: 'Century Gothic';">

                <a href="{{ route('threadCreate') }}" class="btn btn-primary btn-md ml-3 mb-3">Add New Thread</a>

                <div class="border-bottom"></div>

                <div class="mx-3 pt-2 mb-2">

                    <h4>Browse</h4>

                </div>

                    <ul style="list-style:none;">

                        <a class="text-decoration-none active" href="{{ route('threadIndex') }}"><h6 class="pb-1 text-dark">All threads</h6></a>

                        @if(auth()->check())
                            <a class="text-decoration-none" href="/threads?by={{ auth()->user()->id }}"><h6 class="pb-1 text-dark">My Threads</h6></a>
                        @endif

                        <a class="text-decoration-none" href="/threads?popular=1"><h6 class="pb-1 text-dark">All Time Popular</h6></a>
                        <a class="text-decoration-none" href="#"><h6 class="pb-1 text-dark">Unanswerd Threads</h6></a>

                    </ul>

            </div>

            <div class="col-md-8 px-5 pre-scrollable" style="max-height: 1150px;">

                    @foreach($threads as $thread)
                        <div class="card border-0 rounded" id="threadCard">

                            <div class="card-title px-1 py-1 pl-3 mx-2 my-2" style="font-family: 'Century Gothic'">

                                <!-- replies count with thread path link -->
                                <p class="float-right text-dark"> {{ $thread->replies_count }}
                                <img src="https://img.icons8.com/color/48/000000/comments.png" alt="" style="width: 15px; height: 15px;"></p>

                                <!-- Thread title -->
                                <a href="{{ $thread->path() }}" style="text-decoration: none;">
                                    <h5 class="text-dark"><strong>{{ $thread->title }}</strong></h5>
                                </a>

                                <img src="https://img.icons8.com/color/48/000000/hand-with-pen.png" style="width: 20px; height: 20px;">
                                <small class="ml-2" style="font-size: 12px;"><a href="{{ $thread->creater->path() }}" style="text-decoration: none;">{{ $thread->creater->name}}</a></small>

                            </div>

                            <div class="card-body overflow-hidden">

                                <articel>

                                    <div class="body pl-1" style="max-height: 5rem; font-family: 'Century Gothic';">{{ $thread->body }}</div>

                                </articel>

                            </div>

                        </div>
                        <div class="border-bottom"></div>
                    @endforeach
            </div>

            <div class="col-md-2 border-left overflow-auto" style="font-family: 'Century Gothic'; max-height: 450px;">

                <div class="text-center py-2">
                    <h5>Channels</h5>
                </div>

                <div class="border-bottom"></div>

                <ul class="list-group text-center py-2" style="list-style: none;">

                    @foreach($channels as $channel)

                        <a class="dropdown-item"
                           href="{{ route('allThreads_of_a_channel', $channel->slug) }}">{{ $channel->name }}</a>

                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
