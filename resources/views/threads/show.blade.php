@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <!-- show a single thread-->
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">

                        <a href="#">&nbsp;{{ $thread->creater->name }}</a> &nbsp;posted &nbsp;{{ $thread->title }}

                    </div>

                    <!-- card for each thread -->
                    <div class="card-body">

                        {{ $thread->body }}

                    </div>

                </div>

            </div>
        </div>

        <!-- replies showing section starts from here -->
        @if($thread->replies()->count() > 0)
            <!-- Threads reaplies showing section -->
            <div class="row justify-content-center mt-3">

                <div class="col-md-8">

                   <div class="card">

                       <!-- replies card header -->
                       <div class="card-header">Replies</div>

                       <div class="card-body">

                           @foreach($thread->replies as $reply)

                               <!-- including the reply section -->
                               @include('threads.reply')

                           @endforeach

                       </div>

                   </div>

                </div>
            </div>
        @endif

        <!-- thread reply section starts from here -->
        @if(Auth::check())

            <!-- Threads reaplies creaitng section -->
            <div class="row justify-content-center mt-5">

                <div class="col-md-8">

                    <div class="card">

                        <!-- replies card header -->
                        <div class="card-header">Make a reply</div>
                        @include('includes.errors')
                        <div class="card-body">

                            <form method="POST" action="{{ route('addNewReply', $thread->id) }}">@csrf

                                <div class="form-group">
                                    <textarea name="body" id="body" cols="6" rows="3"
                                              class="form-control" placeholder="Have something to say..."></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-light" type="submit"> Post a reply </button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        @else
            <div class="row justify-content-center mt-5">

                <div class="col-md-8">
                    <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion</p>
                </div>

            </div>
        @endif
    </div>
@endsection
