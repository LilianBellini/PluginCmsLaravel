<?php


namespace Lilian\PluginCmsLaravel\Models\Post; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'locale',
        'title',
        'content',
        'excerpt',
        'slug',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public static function generateExcerpt($text)
    {
        $text = strip_tags($text);
        if (strlen($text) > 135) {
            return substr($text, 0, 132) . '...';
        }
        return $text;
    }
}
