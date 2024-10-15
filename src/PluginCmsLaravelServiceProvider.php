<?php

namespace Lilian\Plugincmslaravel;

use Illuminate\Support\ServiceProvider;

class PluginCmsLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Charger les migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
