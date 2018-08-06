<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Buy', function($app) {
            return new \App\Libs\Providers\BuyProvider();
        });

        $this->app->singleton('Location', function($app) {
            return new \App\Libs\Providers\LocationProvider();
        });

        $this->app->singleton('Home', function($app) {
            return new \App\Libs\Providers\HomeProvider();
        });

        $this->app->singleton('AboutUs', function($app) {
            return new \App\Libs\Providers\AboutUs();
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return ['Buy', 'Home', 'Location', 'AboutUs'];
    }
}
