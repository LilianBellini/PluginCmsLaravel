<?php

namespace LilianBellini\PluginCmsLaravel\Models\Post; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'category_id', 'user_id', 'status'];

    // protected function createdAt(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::parse($value)->diffForHumans()
    //     );
    // }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    public function getNextAttribute()
    {
        return static::wherecategoryId($this->category_id)->where('id', '>', $this->id)->published()->orderBy('id', 'asc')->first();
    }

    public function getPreviousAttribute()
    {
        return static::wherecategoryId($this->category_id)->where('id', '<', $this->id)->published()->orderBy('id', 'desc')->first();
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return asset('import/assets/falcon.jpg');
        }

        return $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function translations()
    {
        return $this->hasMany(PostTranslation::class);
    }

    public static function generateExcerpt($text)
    {
        if (strlen($text) > 135) {
            return substr($text, 0, 132) . '...';
        }

        return $text;
    }

    /**
     * Trouve un post par son slug et locale.
     *
     * @param string $locale
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function findBySlug($locale, $slug)
    {
        return self::whereHas('translations', function ($query) use ($locale, $slug) {
            $query->where('locale', $locale)
                  ->where('slug', $slug);
        })
        ->with([
            'user:id,name',
            'category.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'tags.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
        ])
        ->whereStatus(true)
        ->firstOrFail();
    }

    public static function findSlugWithoutLocale($slug)
    {
        // Trouver le post par le slug donné dans n'importe quelle locale
        return self::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
        ->whereStatus(true)
        ->firstOrFail();

        // Si le post est trouvé, trouver le slug dans la locale demandée
    }

        // Retourner null si aucun résultat trouvé


    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
