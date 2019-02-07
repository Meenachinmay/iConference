<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'body'];

    // A thread can have many replies
    public function replies()
    {
        return $this->hasMany('App\Reply');
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
