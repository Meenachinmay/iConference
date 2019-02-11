<div class="card mb-4">

    <div class="card-header">

        @if(Auth::check())
            <!-- mark as a favorite thread -->
            <form method="POST" action="{{ route('addFavoriteReply', $reply->id) }}">@csrf

                <button class="btn btn-light btn-sm float-right" type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    <strong>
                        @if($reply->favorites_count == 0)
                            Star
                        @else
                           {{ $reply->favorites_count }} {{str_plural('Star', $reply->favorites_count)}}
                        @endif
                    </strong>
                </button>

            </form>

        @endif

        <a href="{{ $reply->owner->path() }}">
        &nbsp; <strong>{{ $reply->owner->name }}</strong></a> said {{ $reply->created_at->diffForHumans() }}...
    </div>

    <!-- card for each thread -->
    <div class="card-body">

        {{ $reply->body }}

    </div>

</div>