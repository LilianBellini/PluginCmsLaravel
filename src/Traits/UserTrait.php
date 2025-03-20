<?php

namespace LilianBellini\PluginCmsLaravel\Traits;

use LilianBellini\PluginCmsLaravel\Models\Post\Post;
use LilianBellini\PluginCmsLaravel\Models\Post\Category;
use LilianBellini\PluginCmsLaravel\Models\Post\Page;
use LilianBellini\PluginCmsLaravel\Models\Role;

trait UserTrait
{
    /**
     * Retourne l'URL de l'avatar de l'utilisateur.
     *
     * @param string $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        return $value; // Vous pouvez personnaliser ce retour pour l'URL complète si nécessaire
    }

    /**
     * Récupère les posts de l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Récupère les catégories de l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Récupère les pages de l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Récupère le rôle de l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique.
     *
     * @param string $role_name
     * @return bool
     */
    public function getRole($role_name)
    {
        return $this->role()->where('name', $role_name)->exists();
    }
}
