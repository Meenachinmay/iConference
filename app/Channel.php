<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    // a channel can have many threads
    public function threads(){
        return $this->hasMany(Thread::class);
    }

    // changing default route key name
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
