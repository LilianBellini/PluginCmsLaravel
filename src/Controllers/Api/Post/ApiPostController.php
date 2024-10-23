<?php

namespace Lilian\PluginCmsLaravel\Controllers\Api\Post;

use Lilian\PluginCmsLaravel\Controllers\Controller;
use Lilian\PluginCmsLaravel\Resources\Post\PostResource;
use Lilian\PluginCmsLaravel\Models\Post\Post;
use Lilian\PluginCmsLaravel\Traits\ApiResponse;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $locale = $request->route('locale') ?? app()->getLocale();

        $posts = Post::with([
            'user',
            'category.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'tags.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
            ->whereStatus(true)
            ->orderByDesc('id')
            ->paginate(15);

        return $this->retrieveResponse(data: PostResource::collection($posts));
    }

    public function show(Request $request, $locale, $id)
    {
        $post = Post::with([
            'user',
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
            ->whereId($id)
            ->whereStatus(true)
            ->firstOrFail();

        return $this->retrieveResponse(data: PostResource::make($post));
    }

    public function showBySlug(Request $request, $locale, $slug)
    {
        $post = Post::findBySlug($locale, $slug);
        return $this->retrieveResponse(data: PostResource::make($post));
    }

    public function changeLocaleSlug(Request $request, $locale, $slug)
    {
        $post = Post::findSlugWithoutLocale($slug) ; 
        return $this->retrieveResponse(data: PostResource::make($post));
    }
}

