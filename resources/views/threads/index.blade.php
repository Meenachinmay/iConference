@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Forum Threads</div>

                    <!-- card for each thread -->
                    <div class="card-body">

                        @foreach($threads as $thread)
                            <div class="card mb-3">
                                <div class="card-body">

                                    <articel>
                                        <a href="{{ route( 'threadShow',
                                        ['channel' => $thread->channel->slug, 'thread' => $thread->id] ) }}">
                                            <h4>{{ $thread->title }}</h4>
                                        </a>
                                        <div class="body">{{ $thread->body }}}</div>
                                    </articel>
                                    <hr>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
