<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // The default string length must be 191 bytes, 
        // because of the stated prefix limitation problem, 
        // present in MySQL versions 5.6 or earlier
        Schema::defaultStringLength(191);
    }
}
