<?php

namespace Systemin\PluginCmsLaravel;

use Illuminate\Support\ServiceProvider;
use Systemin\PluginCmsLaravel\Middleware\RoleAdmin;
use Systemin\PluginCmsLaravel\Middleware\RoleEditor;
use Illuminate\Support\Facades\Blade;

class PluginCmsLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Charger les migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'plugincmslaravel');
        // Permettre la publication des vues
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/plugincmslaravel'),
        ], 'views');


        $this->loadMiddleware();
        $this->loadBladeDirective();
        $this->loadRoutesWithMiddleware();
    }

    public function loadMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('editor', RoleEditor::class);
        $router->aliasMiddleware('admin', RoleAdmin::class);
    }

    public function loadBladeDirective()
    {
        // Enregistrer les directives personnalisées
        Blade::directive('editor', function () {
            return "<?php if (Auth::check() && (Auth::user()->role->id == 2 || Auth::user()->role->id == 1)): ?>";
        });

        Blade::directive('endeditor', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('admin', function () {
            return "<?php if (Auth::check() && (Auth::user()->role->id == 1)): ?>";
        });

        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });


        Blade::directive('guest', function () {
            return "<?php if (Auth::check() && (Auth::user()->role->id == 3)): ?>";
        });

        Blade::directive('endguest', function () {
            return "<?php endif; ?>";
        });
    }

    protected function loadRoutesWithMiddleware()
    {
        \Illuminate\Support\Facades\Route::middleware('web')
            ->namespace('Lilian\PluginCmsLaravel\Controllers')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
            });
            
            \Illuminate\Support\Facades\Route::middleware('api')
            ->prefix('api')  // Ajoute le préfixe 'api' à toutes les routes dans api.php
            ->namespace('Lilian\PluginCmsLaravel\Controllers')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
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
