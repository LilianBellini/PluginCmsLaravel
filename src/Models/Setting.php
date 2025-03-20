<?php

namespace LilianBellini\PluginCmsLaravel\Models ; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LilianBellini\PluginCmsLaravel\Database\Factories\SettingFactory;


class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'description',
        'about',
        'copy_rights',
        'contact_email',
        'url_fb',
        'url_insta',
        'url_twitter',
        'url_linkedin'
    ];

    
    protected static function newFactory()
    {
        return SettingFactory::new();
    }
}
