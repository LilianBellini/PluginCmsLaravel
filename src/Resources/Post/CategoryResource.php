<?php

namespace Lilian\PluginCmsLaravel\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale = $request->route('locale') ?? app()->getLocale();
        $translation = $this->getTranslation($locale);

        return [
            'id' => $this->id,
            'name' => $translation ? $translation->name : null,
            'slug' => $translation ? $translation->slug : null,
        ];
    }
}
