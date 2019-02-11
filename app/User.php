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

    //
    public function getRouteKeyName()
    {
        return 'name';
    }

    //
    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    //
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
