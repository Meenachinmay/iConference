@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card mt-1">
                    <div class="card-header">Create a Thread</div>

                    <!-- card for each thread -->
                    <div class="card-body">

                        <form method="POST" action="/threads">@csrf

                            <div class="form-group">

                                <label> Title </label>

                                <input class="form-control" type="text" name="title" placeholder="Add your title here">

                            </div>

                            <div class="form-group">

                                <label> Thread content </label>

                                <textarea class="form-control" type="text"
                                          name="body" rows="10" cols="15" placeholder="Place your content here..."></textarea>

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
