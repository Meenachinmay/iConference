<?php

namespace App\Providers;

use function foo\func;
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
        //
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
            $view->with('channels', \App\Channel::all());
        });

        Schema::defaultStringLength(191); // to increase string length
    }
}
