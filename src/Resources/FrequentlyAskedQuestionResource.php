<?php

namespace Lilian\PluginCmsLaravel\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class FrequentlyAskedQuestionResource extends JsonResource
{
    public function toArray($request)
    {
        // Récupérer la langue depuis la requête ou utiliser la langue par défaut de l'application
        $locale = $request->route('locale') ?? app()->getLocale();
        Carbon::setLocale($locale);

        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('j F Y'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('j F Y'),
        ];
    }
}
