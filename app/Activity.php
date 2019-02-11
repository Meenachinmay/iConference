<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];


    public function subject()
    {
        return $this->morphTo();
    }

    //
    public static function feed($user, $takeCount = 50){

        return $user->activity()->latest()->with('subject')->take($takeCount)->get()->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });

    }
}
