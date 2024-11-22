<?php

namespace Systemin\PluginCmsLaravel\Console\Commands;

use Illuminate\Console\Command;

class SeedDatabaseCommand extends Command
{
    protected $signature = 'plugin-cms:seed';
    protected $description = 'Seed the database with initial data from PluginCmsLaravel package';

    public function handle()
    {
        $this->call('db:seed', ['--class' => 'Systemin\\PluginCmsLaravel\\Database\\Seeders\\DatabaseSeeder']);
        $this->info('Database seeded with PluginCmsLaravel data.');
    }
}
