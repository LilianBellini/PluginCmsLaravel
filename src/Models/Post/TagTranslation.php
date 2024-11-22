<?php

namespace Systemin\PluginCmsLaravel\Models\Post; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'locale',
        'name',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
