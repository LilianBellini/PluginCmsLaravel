<?php

namespace Lilian\PluginCmsLaravel\Database\Seeders;


use Lilian\PluginCmsLaravel\Models\User;
use Lilian\PluginCmsLaravel\Models\Setting;
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
        // Create a specific user with a given email
        if (config('app.env') == "local"){
            User::create([
                'name' => 'Lilian',
                'role_id' => 1,
                'email' => 'lilian@systemin.fr', // Remplis ce champ avec l'adresse email souhaitée
                'password' => bcrypt('lilian@systemin.fr'), // Assure-toi de définir un mot de passe sécurisé
            ]);
            User::create([
                'name' => 'Nico',
                'role_id' => 1,
                'email' => 'nico@systemin.fr', // Remplis ce champ avec l'adresse email souhaitée
                'password' => bcrypt('nicon@systemin.fr'), // Assure-toi de définir un mot de passe sécurisé
            ]);
        }
        

        Setting::factory(1)->create();
        
        $this->call([
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
