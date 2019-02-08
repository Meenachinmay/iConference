@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <!-- Dashboard content panel -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Content</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Online users panel-->
        <div class="col-md-3 ml-5 pre-scrollable position-sticky">
            <div class="card">
                <div class="card-header">List of Online Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">

                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    @if($user->isOnline())
                                        <li class="text-success float-right"></li>
                                    @else
                                        <li class="text-muted float-right"></li>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
