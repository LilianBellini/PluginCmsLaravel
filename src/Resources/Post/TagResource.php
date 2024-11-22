<?php

namespace Systemin\PluginCmsLaravel\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = $request->route('locale') ?? app()->getLocale();
        $translation = $this->getTranslation($locale);

        return [
            'id' => $this->id,
            'name' => $translation ? $translation->name : null,
        ];
    }
}
