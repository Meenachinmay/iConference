@extends('layouts.app')

@section('content')

    <div class="container col-lg-10">

        <div class="row justify-content-md-center">

            <!-- Dashboard content panel -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Welcome to iConference's Chatting room</div>

                    <div class="card-body" id="app">

                        <chat-component></chat-component>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection