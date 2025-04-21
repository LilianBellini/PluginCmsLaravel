<?php
// City.php  (Sector identique)
namespace LilianBellini\PluginCmsLaravel\Models;
use Illuminate\Database\Eloquent\Model;
use LilianBellini\PluginCmsLaravel\Models\Concerns\HasTranslations;

class City extends Model
{
    use HasTranslations;
    protected function translationModel(): string { return CityTranslation::class; }
}
