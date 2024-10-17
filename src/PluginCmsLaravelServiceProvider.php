<?php

namespace Lilian\Plugincmslaravel;

use Illuminate\Support\ServiceProvider;
use Lilian\PluginCmsLaravel\Middleware\RoleAdmin;
use Lilian\PluginCmsLaravel\Middleware\RoleEditor;
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
        $this->app['router']->aliasMiddleware('editor', RoleEditor::class);
        $this->app['router']->aliasMiddleware('admin', RoleAdmin::class);

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

 

        $this->loadRoutesWithMiddleware();
    }

    protected function loadRoutesWithMiddleware()
    {
        \Illuminate\Support\Facades\Route::middleware('web')
            ->namespace('Lilian\PluginCmsLaravel\Controllers')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
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
