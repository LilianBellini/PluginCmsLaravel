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
        $this->loadRoutesWithMiddleware();
    }

    protected function loadRoutesWithMiddleware()
{
    \Illuminate\Support\Facades\Route::middleware('web')
        ->namespace('Lilian\PluginCmsLaravel\Controllers')
        ->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
}

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->commands([
            \Lilian\PluginCmsLaravel\Console\Commands\SeedDatabaseCommand::class,
        ]);
    }
}
