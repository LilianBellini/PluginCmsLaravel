<?php

namespace LilianBellini\PluginCmsLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use LilianBellini\PluginCmsLaravel\Models\Concerns\HasTranslations;

class Page extends Model
{
    use HasTranslations;   // ← le trait est enfin appliqué

    /**
     * Champs gérés dans la table parente.
     */
    protected $fillable = [
        'city_id',
        'sector_id',
        'template',
    ];
    protected function translationModel(): string
    {
        return PageTranslation::class;
    }

    /*--------------------------------------------------------------
    | Relations
    --------------------------------------------------------------*/
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
