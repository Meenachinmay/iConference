<?php


namespace App\Filters;



use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    // filters array
    protected $filters = ['by', 'popular', 'unanswered'];
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

    protected function popular(){

        // removing existing order on the query (one we have in ThreadsController's getThreads method => (in which we are getting
        // latest threads) )
        // explicitly clear any other orders
        $this->builder->getQuery()->orders = [];

        // ordering the incoming threads with replies count
        return $this->builder->orderBy('replies_count', 'desc');
    }

    protected function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }
}