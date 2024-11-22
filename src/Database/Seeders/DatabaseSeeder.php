<?php

namespace Systemin\PluginCmsLaravel\Database\Seeders;


use App\Models\User;
use Systemin\PluginCmsLaravel\Models\Setting;
use Systemin\PluginCmsLaravel\Database\Seeders\TagSeeder;
use Systemin\PluginCmsLaravel\Database\Seeders\CategorySeeder;
use Systemin\PluginCmsLaravel\Database\Seeders\PostSeeder;
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
                'name' => 'Systemin',
                'role_id' => 1,
                'email' => 'Systemin@systemin.fr', // Remplis ce champ avec l'adresse email souhaitée
                'password' => bcrypt('Systemin@systemin.fr'), // Assure-toi de définir un mot de passe sécurisé
            ]);
            User::create([
                'name' => 'Nico',
                'role_id' => 1,
                'email' => 'nico@systemin.fr', // Remplis ce champ avec l'adresse email souhaitée
                'password' => bcrypt('nico@systemin.fr'), // Assure-toi de définir un mot de passe sécurisé
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
