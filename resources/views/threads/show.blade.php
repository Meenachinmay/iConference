@extends('layouts.app')

@section('content')

    <thread-component :first-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container col-lg-12 mt-3">

            <!-- show a single thread-->
            <div class="row justify-content-md-center">

                <div class="col-md-7" style="padding-left: 1rem;">

                    <!-- thread body and title -->
                    <div class="card shadow-sm">

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

                    <!-- Replies component coming from vuejs with leave a reply section mark -->
                    <replies auth-ok="{{ Auth::check()}}" @removed="repliesCount--" @added="repliesCount++"></replies>

                </div>

                <div class="col-md-4">

                    <!-- thread body and title -->
                    <div class="card rounded-lg shadow-sm">

                        <!-- card for each thread -->
                        <div class="card-body">

                            This thread was published {{ $thread->created_at->diffForHumans() }}
                            by <a href="#">{{ $thread->creater->name }}</a>.
                            and currently has <span v-text="repliesCount"></span> {{ str_plural('reply', $thread->replies_count) }} on it.

                        </div>

                        <!-- Subscribe button to subscribe a thread -->
                        @if(Auth::check())
                            <p class="mt-2 ml-3 px-1">

                                <subscribe :active="{{ $thread->isSubscribedTo ? 'true' : 'false'}}"></subscribe>

                            </p>
                        @endif

                    </div>

                </div>
                <!-- thread body and title -->

            </div> <!-- row ends here -->

        </div> <!-- container ends here -->
    </thread-component>
@endsection
