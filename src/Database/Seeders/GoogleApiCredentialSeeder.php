<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use LilianBellini\PluginCmsLaravel\Models\Admin\Google\GoogleApiCredential;

class GoogleApiCredentialSeeder extends Seeder
{
    public function run(): void
    {
        GoogleApiCredential::firstOrCreate([], [
            'client_id'     => '',
            'client_secret' => '',
            'site_url'      => '',
            'token'         => null,
            'email'         => null,
        ]);
    }
}
