@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card mt-1">
                    <div class="card-header">Create a Thread</div>

                    <!-- card for each thread -->
                    <div class="card-body">

                        @include('includes.errors')
                        <form method="POST" action="{{ route('threadCreateThread') }}">@csrf

                            <!-- Choose a channel -->
                            <div class="form-group">

                                <label> Choose a channel </label>

                                <select class="form-control" name="channel_id" id="channel_id" required>
                                    <option value="">Choose One...</option>
                                    @foreach($channels as $channel)

                                        <option value="{{ $channel->id }}"
                                                {{ old('channel_id' == $channel->id ? 'selected' : '') }}>
                                            {{ $channel->name }}</option>

                                    @endforeach


                                </select>

                            </div>

                            <!-- Create a title field -->
                            <div class="form-group">

                                <label> Title </label>

                                <input class="form-control" type="text" name="title"
                                       placeholder="Add your title here" value="{{ old('title') }}" required>

                            </div>

                            <!-- Create a content field -->
                            <div class="form-group">

                                <label> Thread content </label>

                                <textarea class="form-control" type="text"
                                          name="body" rows="10" cols="15"
                                          placeholder="Place your content here..." required>{{ old('body') }}</textarea>

                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"> Post Thread </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
