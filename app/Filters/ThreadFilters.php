<?php


namespace App\Filters;



use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    // filters array
    protected $filters = ['by'];
    /**
     * Filter the query by a given UserName
     *
     * @param $builder
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        // filtering query
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}