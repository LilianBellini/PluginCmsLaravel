<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;


use App\Models\User;
use LilianBellini\PluginCmsLaravel\Models\Setting;
use LilianBellini\PluginCmsLaravel\Database\Seeders\TagSeeder;
use LilianBellini\PluginCmsLaravel\Database\Seeders\CategorySeeder;
use LilianBellini\PluginCmsLaravel\Database\Seeders\PostSeeder;
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
                'name' => 'LilianBellini',
                'role_id' => 1,
                'email' => 'LilianBellini@systemin.fr', // Remplis ce champ avec l'adresse email souhaitée
                'password' => bcrypt('LilianBellini@systemin.fr'), // Assure-toi de définir un mot de passe sécurisé
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
