<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema ;

use App\Role ; 

use App\Barangay ; 

use App\User ; 
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(256);


        if ($this->app->isLocal()) {
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }

        if (! Route::is('/')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }




    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
