<?php


namespace LilianBellini\PluginCmsLaravel\Models\Post; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function translations()
    {
        return $this->hasMany(TagTranslation::class);
    }

    public function publishedPosts()
    {
        return $this->posts()->with(['user', 'category'])->whereStatus(true)->orderBy('id', 'desc')->paginate(10);
    }

    public function countTagsForPublishedPosts()
    {
        return $this->posts()->whereStatus(true)->count();
    }
    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
