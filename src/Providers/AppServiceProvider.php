<?php

namespace LilianBellini\PluginCmsLaravel\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role->id == 1;
        });
        Blade::if('editor', function () {
            return auth()->check() && (auth()->user()->role->id == 2 || auth()->user()->role->id == 1);
        });
        Blade::if('guest', function () {
            return auth()->check() && (auth()->user()->role->id == 3);
        });
        Carbon::setLocale(config('app.locale'));
    }
}
