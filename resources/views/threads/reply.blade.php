<reply inline-template>

    <div class="card mb-4">

        <div class="card-header">

            @can('update', $reply)
                <!-- mark as a favorite thread -->
                <form method="POST" action="{{ route('addFavoriteReply', $reply->id) }}">@csrf

                    <button class="btn btn-success btn-sm float-right" type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        <strong>
                            @if($reply->favorites_count == 0)
                                <strong>Star</strong>
                            @else
                               {{ $reply->favorites_count }} {{str_plural('Star', $reply->favorites_count)}}
                            @endif
                        </strong>
                    </button>

                </form>

            @endcan

            <a href="{{ $reply->owner->path() }}">
            &nbsp; <strong>{{ $reply->owner->name }}</strong></a> said {{ $reply->created_at->diffForHumans() }}...
        </div>

        <!-- card for each thread -->
        <div class="card-body">

            <div v-if="editing">
                <textarea></textarea>
            </div>

            <div v-else>

                {{ $reply->body }}

            </div>

        </div>

        <!-- card footer -->
        @can('update', $reply)

            <div class="card-footer">

                <div class="row">

                    <button class="btn btn-sm btn-light" @click="editing = true">Edit</button>

                    <form method="POST" action="{{ $reply->path() }}">@csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger ml-2" type="submit"><strong>Delete</strong></button>
                    </form>

                </div>

            </div>

        @endcan


    </div>

</reply>