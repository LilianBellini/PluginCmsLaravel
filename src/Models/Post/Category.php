<?php

namespace Systemin\PluginCmsLaravel\Models\Post; 

use App\Models\User; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function publishedPosts()
    {
        return $this->posts()->with(['user:id,name', 'category'])->published()->latest('created_at')->paginate(10);
    }
    
    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
