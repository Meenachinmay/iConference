@extends('layouts.app')

@section('content')

    <div class="container col-lg-12">

        <div class="row justify-content-center">

            <div class="col-md-10 mb-3 mt-1">

                <div class="card" style="font-family: 'Century Gothic'; color:#5a6268;">

                    <div class="card-body">

                        <h1> {{ $profileUser->name }} </h1>

                        <h6> <strong>Member Since {{ $profileUser->created_at->diffForHumans() }}</strong></h6>

                    </div>

                </div>
                <hr>
            </div>
            <!-- User Profile section ends here -->

            <!-- thread body and title -->
            <div class="col-md-8">
                @forelse($activities as $date => $record)

                    <h4>{{ $date }}</h4>
                    <hr>

                    @foreach($record as $activity)

                        @if($activity->type == "created_thread")
                            @include('profiles.activities.created_thread')
                        @endif

                        {{--@if($activity->type == "created_favorite")--}}
                            {{--@include('profiles.activities.created_favorited')--}}
                        {{--@endif--}}

                        @if($activity->type == "created_reply")
                            @include('profiles.activities.created_reply')
                        @endif

                    @endforeach

                @empty
                    <h5>There is no activities, till so far.</h5>
                    <hr>
                @endforelse

            </div>
            <!-- thread body and title -->

        </div>

    </div>

@endsection()