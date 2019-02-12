
<reply-component inline-template xmlns:v-on="http://www.w3.org/1999/xhtml" :attributes="{{ $reply }}">
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

            <div v-if="seen">

                <div class="form-group">

                    <textarea class="form-control" v-model="body"></textarea>

                </div>

                <button class="btn btn-sm btn-primary" v-on:click="update">Update</button>

                <button class="btn btn-sm btn-link" v-on:click="seen = !seen">Cancel</button>

            </div>

            <div v-else v-text="body"></div>

    </div>

    <!-- card footer -->
    @can('update', $reply)

        <div class="card-footer">

            <div class="row">

                <!-- edit a reply -->
                <button class="btn btn-sm btn-light" v-on:click="seen = !seen">Edit</button>

                <!-- delete a reply -->
                <button class="btn btn-sm btn-danger" @click="update_">Delete</button>


            </div>

        </div>

    @endcan

</div>

</reply-component>