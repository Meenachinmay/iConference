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

    // this method will boot up everytime we perform an activity
    protected static function bootRecordsActivity(){

        if (auth()->guest()) return;

        // whenever we will create a thread a thread created activity will be recorded here
        // in the activity table
        foreach (static::getActivitesToRecord() as $event) {

            static::$event(function ($model) use ($event) {

                $model->recordActivity($event);

            });
        }

        // deleteing all the activities and replies when deleting an activity
        static::deleting(function ($thread){

            $thread->activity()->delete();

        });

    }


    protected static function getActivitesToRecord()
    {
        return ['created'];
    }

    // record and activity like creating a reply or liking a reply
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);

    }


    // simply creating a morphmany relationships
    protected function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }


    // to get which activity user has been done
    protected function getActivityType($event)
    {
        return $event . '_' . strtolower((new \ReflectionClass($this))->getShortName());
    }
}