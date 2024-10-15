<?php

namespace lilian\PluginCmsLaravel;

use Illuminate\Support\ServiceProvider;

class MonPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Enregistre les services de ton package ici
    }

    public function boot()
    {
        // Place les publications de configuration, les migrations, etc.
    }
}
