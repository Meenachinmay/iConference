<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use Favorites_info, RecordsActivity;

    protected $fillable = ['user_id', 'thread_id', 'body'];

    // with every single reply always load 'owner' and 'favorites table information'
    protected $with = ['owner', 'favorites'];

    // replies belongs to owner (owner means the creater of the threads)
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

}
