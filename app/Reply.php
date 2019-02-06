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
}
