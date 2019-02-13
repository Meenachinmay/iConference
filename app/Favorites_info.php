<?php
/**
 * Created by PhpStorm.
 * User: meena
 * Date: 2/9/2019
 * Time: 10:30 AM
 */

namespace App;


trait Favorites_info
{

    // checking that if a current user already marked this reply as favotite
    public function isFavorited()
    {
        // make a look into favorite table that authenticated user liked it before or not
        return !!$this->favorites->where('user_id', auth()->id())->count();
    }


    // get favorites count from here (this is a custom attribute so we can append this in Reply model so the with every instance of reply we
    // we will get a copy of this.)
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    // get favorites count from here (this is a custom attribute so we can append this in Reply model so the with every instance of reply we
    // we will get a copy of this.)
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }


    //
    public function favorites()
    {
        // we will back on this later (morph many relatioship)
        return $this->morphMany(Favorite::class, 'favorited');
    }


    // mark a reply as favorite (used in FavoriteController)
    public function favorite()
    {
        $arguments = ['user_id' => auth()->id()];

        if (!$this->favorites()->where($arguments)->exists()) {
            $this->favorites()->create($arguments);
        }

    }


    //  a method to dislike a reply
    public function unfavorite()
    {
        $arguments = ['user_id' => auth()->id()];

        // fetching and deleting a like
        $this->favorites()->where($arguments)->delete();
    }
}