<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use Favorites_info, RecordsActivity;

    protected $fillable = ['user_id', 'thread_id', 'body'];

    // with every single reply always load 'owner' and 'favorites table information'
    protected $with = ['owner', 'favorites'];


    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        // delete related favories ids from favorites table when deleteing a reply
        static::deleting(function ($reply){

            $reply->favorites->each(function ($favorite) {

                $favorite->delete();

            });

        });
    }

    // path for a reply
    public function path()
    {
        return "/replies/{$this->id}";
    }

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
