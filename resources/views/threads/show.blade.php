@extends('layouts.app')

@section('content')

    <thread-component :first-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container col-lg-12 mt-3">

            <!-- show a single thread-->
            <div class="row justify-content-md-center">

                <div class="col-md-6" style="padding-left: 1rem;">

                    <!-- thread body and title -->
                    <div class="card">

                        <div class="card-header">

                            @can('update', $thread)

                                <form method="POST" action="{{ $thread->path() }}">@csrf
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-link float-right" type="submit"><strong>Delete Thread</strong></button>
                                </form>

                            @endcan

                            <a href="{{ $thread->creater->path() }}">&nbsp;<strong>{{ $thread->creater->name }}</strong></a> &nbsp;posted &nbsp;{{ $thread->title }}

                        </div>

                        <!-- card for each thread -->
                        <div class="card-body">

                            {{ $thread->body }}

                        </div>

                    </div>

                    <!-- thread body and title section ends here -->
                    <!-- thread replies -->
                    @if($thread->replies_count > 0)
                        <!-- thread replies -->
                        <div class="card mt-4">

                            <!-- replies card header -->
                            <div class="card-header"><h5 class="font-weight-light">Replies</h5></div>

                            <div class="card-body">

                                 {{--A vue component to show all the replies --}}
                                <replies auth-ok="{{ Auth::check()}}" :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

                                <!-- creating pagination links here -->
                                {{--{{ $replies->links() }}--}}

                            </div>

                        </div>

                    @endif
                    <!-- thread replies -->

                    @if(auth()->id())

                        <!-- reply box -->
                        <div class="card mt-4">

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

                    @else

                        <div class="row justify-content-center mt-5">

                            <div class="col-md-8">
                                <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion</p>
                            </div>

                        </div>

                    @endif
                    <!-- reply box -->

                </div>

                <div class="col-md-4">

                    <!-- thread body and title -->
                    <div class="card">

                        {{--<div class="card-header">--}}

                            {{--<a href="#">&nbsp;{{ $thread->creater->name }}</a> &nbsp;posted this--}}
                            {{--{{ $thread->created_at->diffForHumans() }} and currently have--}}
                            {{--{{ $thread->replies()->count() }} replies on it.--}}

                        {{--</div>--}}

                        <!-- card for each thread -->
                        <div class="card-body">

                            This thread was published {{ $thread->created_at->diffForHumans() }}
                            by <a href="#">{{ $thread->creater->name }}</a>.
                            and currently has <span v-text="repliesCount"></span> {{ str_plural('reply', $thread->replies_count) }} on it.

                        </div>

                    </div>

                </div>
                <!-- thread body and title -->

            </div> <!-- row ends here -->

        </div> <!-- container ends here -->
    </thread-component>
@endsection
