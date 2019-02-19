@component('profiles.activities.activity')

    @slot('heading')

        <strong>{{ $profileUser->name }}</strong> replied on

        <a href="{{ $activity->subject->thread->path() }}"><strong>"{{ $activity->subject->thread->title }}"</strong></a>

        {{ $activity->subject->created_at->diffForHumans() }}...

    @endslot

    @slot('body')

        {{ $activity->subject->body }}

    @endslot

@endcomponent
