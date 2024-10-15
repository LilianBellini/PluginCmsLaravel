<?php

namespace Lilian\PluginCmsLaravel\Database\Seeders;

use Lilian\PluginCmsLaravel\Database\Seeders\TagSeeder;
use Lilian\PluginCmsLaravel\Database\Seeders\CategorySeeder;
use Lilian\PluginCmsLaravel\Database\Seeders\PostSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
