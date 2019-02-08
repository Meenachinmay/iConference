<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'body'];


    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        // added a globalQuery scope to count replies on a single thread everytime we fetch that thread
        static::addGlobalScope('replyCount', function ($builder){

            return $builder->withCount('replies');

        });
    }

    // path for a single thread view
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    // A thread can have many replies
    public function replies()
    {
        // fetching the replies for every thread but also along with that fetching the favorite count too for every reply
        // this will decrease the number of queries per request and make process even more faster
        return $this->hasMany('App\Reply')
                ->withCount('favorites')
                ->with('owner');
    }

    // A thread can have a user
    public function creater(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // a thread can have an channel
    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    // a thread can have an channel
    public function scopeFilter($query, $filters)
    {
        // applying the query through filters in short applying filters on query
        return $filters->apply($query);
    }

}
