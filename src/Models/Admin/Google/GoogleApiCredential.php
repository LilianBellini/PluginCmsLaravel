<?php

namespace LilianBellini\PluginCmsLaravel\Models\Admin\Google;

use Illuminate\Database\Eloquent\Model;

class GoogleApiCredential extends Model
{
    protected $table = 'google_api_credentials';

    protected $fillable = [
        'client_id',
        'client_secret',
        'redirect_uri',
        'site_url',
        'token',
        'email',
        'site_url',
    ];
    

    protected $casts = [
        'token' => 'array',
    ];

    public $timestamps = true;
}
