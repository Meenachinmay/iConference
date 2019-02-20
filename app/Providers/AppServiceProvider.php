<?php

namespace App\Providers;

use App\Channel;
use function foo\func;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {

            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // share the channels to all the viewse
        \View::composer('*', function($view){

            // if cache does not have Channels already then make that happpen
            $channels = Cache::rememberForever('channels', function(){
               return Channel::all();
            });

            $view->with('channels', $channels);
        });

        Schema::defaultStringLength(191); // to increase string length
    }
}
