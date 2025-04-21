<?php

// src/Models/CityTranslation.php  (SectorTranslation identique)
namespace LilianBellini\PluginCmsLaravel\Models;
use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $fillable = ['locale','name','slug'];
    public $timestamps = false;
}

