@component('profiles.activities.activity')

    @slot('heading')

        <strong>{{ $profileUser->name }}</strong> liked a reply

        {{--<a href="{{ $activity->subject->thread->path() }}"><strong>"{{ $activity->subject->thread->title }}"</strong></a>--}}

        {{--{{ $activity->subject->created_at->diffForHumans() }}...--}}

    @endslot

    @slot('body')



    @endslot

@endcomponent
