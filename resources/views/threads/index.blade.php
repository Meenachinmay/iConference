@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Forum Threads</div>

                    <!-- main card body for containing each thread -->
                    <div class="card-body">

                        @foreach($threads as $thread)
                            <div class="card mb-3">

                                <div class="card-header">

                                    <!-- replies count with thread path link -->
                                    <a href="{{ $thread->path() }}">
                                        <strong><p class="float-right"> {{ $thread->replies_count }}
                                            {{ str_plural('reply', $thread->replies_count) }}</p></strong></a>

                                    <!-- Thread title -->
                                    <a href="{{ $thread->path() }}">
                                        <h3>{{ $thread->title }}</h3>
                                    </a>

                                    <small style="font-size: 13px;">Posted by - {{ $thread->creater->name}} </small>

                                </div>

                                <div class="card-body">

                                    <articel>

                                        <div class="body">{{ $thread->body }}}</div>

                                    </articel>

                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
