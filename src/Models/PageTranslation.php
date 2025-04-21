<?php

namespace LilianBellini\PluginCmsLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $timestamps = false;          // pas de colonnes created_at / updated_at

    protected $table = 'page_translations';

    protected $fillable = ['locale', 'data'];

    protected $casts = [
        'data' => 'array',               // le JSON ↔︎ tableau PHP
    ];
}
