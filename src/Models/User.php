<?php

namespace Lilian\PluginCmsLaravel\Models ; 

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lilian\Plugincmslaravel\Models\Post\Post ; 
use Lilian\Plugincmslaravel\Models\Post\Category ; 
use Lilian\Plugincmslaravel\Models\Post\Page ; 

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'news_letter',
        'bio',
        'url_fb',
        'url_insta',
        'url_twitter',
        'url_linkedin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value)
    {

        return $value;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getRole($role_name)
    {
        return self::role()->whereName($role_name)->exists();
    }
}
