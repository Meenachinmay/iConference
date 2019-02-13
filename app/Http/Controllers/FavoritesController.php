<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    // for this instance creating a reply as favorite reply
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function store(Reply $reply)
    {
        $reply->favorite();

        return back();
    }


    //
    public function destroy(Reply $reply)
    {
        $reply->unfavorite();

    }
}
