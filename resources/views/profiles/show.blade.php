@extends('layouts.app')

@section('content')

    <div class="container col-lg-12">

        <div class="row justify-content-center">

            <div class="col-md-10 mb-3">

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
                @foreach($activities as $date => $record)

                    <h4>{{ $date }}</h4>
                    <hr>

                    @foreach($record as $activity)

                        @if($activity->type == "created_thread")
                            @include('profiles.activities.created_thread')
                        @endif

                        @if($activity->type == "created_reply")
                            @include('profiles.activities.created_reply')
                        @endif


                    @endforeach
                    <hr>
                @endforeach

            </div>
            <!-- thread body and title -->

        </div>

    </div>

@endsection()