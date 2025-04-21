<?php

// src/Models/CityTranslation.php  (SectorTranslation identique)
namespace LilianBellini\PluginCmsLaravel\Models;
use Illuminate\Database\Eloquent\Model;

class SectorTranslation extends Model
{
    protected $fillable = ['locale','name','slug'];
    public $timestamps = false;
}
