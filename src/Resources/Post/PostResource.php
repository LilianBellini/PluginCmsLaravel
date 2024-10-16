<?php

namespace Lilian\PluginCmsLaravel\Resources\Post;

use Lilian\PluginCmsLaravel\Resources\CommentResource;
use Lilian\PluginCmsLaravel\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        $routeShowPost = $request->routeIs('posts.show') || $request->routeIs('posts.showBySlug');
        $locale = $request->route('locale') ?? app()->getLocale();
        $translation = $this->translations->where('locale', $locale)->first();
        Carbon::setLocale($locale);
        return [
            'id' => $this->id,
            'title' => $translation ? $translation->title : $this->title,
            'image' => asset("storage/" . $this->image),
            'slug' => $translation ? $translation->slug : $this->slug,
            'excerpt' => $translation ? $translation->excerpt : $this->excerpt,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('j F Y'),
            $this->mergeWhen($routeShowPost, [
                'content' => $translation ? $translation->content : $this->content,
                'comments' => CommentResource::collection($this->whenLoaded('comments'))
            ]),
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
