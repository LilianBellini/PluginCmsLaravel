<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoogleApiCredential;

class GoogleApiCredentialSeeder extends Seeder
{
    public function run(): void
    {
        GoogleApiCredential::firstOrCreate([], [
            'client_id'     => '',
            'client_secret' => '',
            'redirect_uri'  => '',
            'site_url'      => '',
            'site_post_url' => '',
            'token'         => null,
            'email'         => null,
        ]);
    }
}
