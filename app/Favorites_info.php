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

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function favorites()
    {
        // we will back on this later (morph many relatioship)
        return $this->morphMany(Favorite::class, 'favorited');
    }

    // mark a reply as favorite (used in FavoriteController)
    public function favorite()
    {
        if (!$this->favorites()->where(['user_id' => auth()->id()])->exists()) {
            $this->favorites()->create(['user_id' => auth()->id()]);
        }

    }
}