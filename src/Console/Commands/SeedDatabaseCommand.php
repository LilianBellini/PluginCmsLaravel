<?php

namespace Lilian\PluginCmsLaravel\Console\Commands;

use Illuminate\Console\Command;

class SeedDatabaseCommand extends Command
{
    protected $signature = 'plugin-cms:seed';
    protected $description = 'Seed the database with initial data from PluginCmsLaravel package';

    public function handle()
    {
        $this->call('db:seed', ['--class' => 'Lilian\PluginCmsLaravel\Database\Seeders']);
        $this->info('Database seeded with PluginCmsLaravel data.');
    }
}
