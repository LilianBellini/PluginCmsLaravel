<?php
// app/Models/SeoProfile.php

namespace LilianBellini\PluginCmsLaravel\Models\Admin\Seo;

use Illuminate\Database\Eloquent\Model;

class SeoProfile extends Model
{
    protected $fillable = [
        'company_name',
        'positioning',
        'values',
        'target_clients',
        'locations',
        'tone',
        'priority_themes',
        'blacklist',
        'image_style_prompt',
        'auto_publish_enabled', 
        'generation_frequency', 
        'auto_publish_generated_article',
        'article_mix_ratio',    
    ];
    

    protected $casts = [
        'values' => 'array',
        'target_clients' => 'array',
        'locations' => 'array',
        'priority_themes' => 'array',
        'blacklist' => 'array',
    ];
}
