<div class="card mb-4">

    <div class="card-header">
        <a href="#">{{ $reply->owner->name }}</a>
        &nbsp; said {{ $reply->created_at->diffForHumans() }}
    </div>

    <!-- card for each thread -->
    <div class="card-body">

        {{ $reply->body }}

    </div>

</div>