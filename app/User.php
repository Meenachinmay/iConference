<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // User profile path
    public function path(){
        return "/profile/{$this->name}";
    }


    // Check user's online status
    public function isOnline(){
        return Cache::has('user-is-online-' . $this->id);
    }


    // user and threads relationship
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }


    // changing the default getRouteGetKeyName method
    public function getRouteKeyName()
    {
        return 'name';
    }


    // all the activities of this user
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }


    // all the replies of this user
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
