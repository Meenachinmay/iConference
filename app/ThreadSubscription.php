<?php

namespace App;

use App\Notifications\ThreadGotReply;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 * @property mixed thread
 */
class ThreadSubscription extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // one to many relationship with thread
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function notify($reply)
    {
        $this->user->notify(new ThreadGotReply($this->thread, $reply));
    }
}
