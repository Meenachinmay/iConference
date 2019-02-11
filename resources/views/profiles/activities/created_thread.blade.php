@component('profiles.activities.activity')

    @slot('heading')

        <strong>{{ $profileUser->name }}</strong>

        published "<strong><a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a></strong>"

        {{ $activity->subject->created_at->diffForHumans() }}...

    @endslot

    @slot('body')

        {{ $activity->subject->body }}

    @endslot

@endcomponent
