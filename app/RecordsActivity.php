<?php
/**
 * Created by PhpStorm.
 * User: meena
 * Date: 2/9/2019
 * Time: 7:46 PM
 */

namespace App;


trait RecordsActivity
{

    //
    protected static function bootRecordsActivity(){

        if (auth()->guest()) return;

        // whenever we will create a thread a thread created activity will be recorded here
        // in the activity table
        static::created(function ($thread){

            $thread->recordActivity('created');

        });

        //
        static::deleting(function ($thread){

            $thread->activity()->delete();

        });

    }

    //
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);

    }

    //
    protected function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    //
    protected function getActivityType($event)
    {
        return $event . '_' . strtolower((new \ReflectionClass($this))->getShortName());
    }
}