<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['user_id', 'thread_id', 'body'];

    // replies belongs to owner (owner means the creater of the threads)
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function favorites()
    {
        // we will back on this later (morph many relatioship)
        return $this->morphMany(Favorite::class, 'favorited');
    }

    // mark a reply as favorite
    public function favorite()
    {
        if(!$this->favorites()->where(['user_id' => auth()->id()])->exists()){
            $this->favorites()->create(['user_id' => auth()->id()]);
        }

    }

    // checking that if a current user already marked this reply as favotite
    public function isFavorited()
    {
        // make a look into favorite table that authenticated user liked it before or not
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
}
