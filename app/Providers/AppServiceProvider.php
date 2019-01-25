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
        $config = Utils::getConfig();
        
        if($config) {
            $web_logo = Utils::getImageLink($config->web_logo);
            $web_ico = Utils::getImageLink($config->web_ico);
            View::share([
                'web_logo' => $web_logo,
                'web_ico'  => $web_ico
            ]);
        }
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
