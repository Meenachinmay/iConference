<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h2>{{ config('app.name', 'iConference') }}</h2>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                <!-- Drop down on navbar for showing threads filters-->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        Browse
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <!-- all threads -->
                        <a class="nav-link" href="{{ route('threadIndex') }}">All Threads</a>

                    @if(auth()->check())

                        <!-- authenticated user's threads -->
                            <a class="nav-link" href="/threads?by={{ auth()->user()->name }}">My Threads</a>

                    @endif

                    <!-- threads by popularity (sorted threads on their replies count -->
                        <a class="nav-link" href="/threads?popular=1">All Time Popular</a>

                        <a class="nav-link" href="/threads?unanswered=1">Unanswered Threads</a>

                    </div>
                </li>


                    <a class="nav-link" href="{{ route('threadCreate') }}">New Thread</a>

                <!-- Drop down on navbar for showing all the channels-->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Channels
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        @foreach($channels as $channel)

                            <a class="dropdown-item"
                               href="{{ route('allThreads_of_a_channel', $channel->slug) }}">{{ $channel->name }}</a>
                            <div class="dropdown-divider"></div>

                        @endforeach

                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <!-- user notifications -->
                    <user-notifications></user-notifications>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('userProfile', Auth::user()) }}"><strong>My Profile</strong></a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <strong>{{ __('Logout') }}</strong>
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>