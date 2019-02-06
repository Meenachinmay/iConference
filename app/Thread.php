<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['user_id', 'title', 'body'];

    // to get a route of a single thread view
//    public function path(){
//        return "threadShow/.{$this->channel->slug}./.{$this->id}.";
//    }


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

}
