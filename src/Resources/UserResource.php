<?php

namespace Systemin\PluginCmsLaravel\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        Carbon::setLocale($locale);
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'avatar' => asset("storage/" . $this->avatar),
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('j F Y'),
        ];
    }
}
