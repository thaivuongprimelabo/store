<?php

namespace App\Providers;

use App\Config;
use App\Helpers\Utils;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        
        // Config
        $config = Config::first();
        
        $web_logo = Utils::getImageLink($config->web_logo);
        
        View::share('web_logo', $web_logo);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
