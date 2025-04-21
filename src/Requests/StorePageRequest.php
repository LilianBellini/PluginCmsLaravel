<?php

namespace LilianBellini\PluginCmsLaravel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'city_id'   => 'required|exists:cities,id',
            'sector_id' => 'required|exists:sectors,id',
            'template'  => 'required|string',
        ];

        foreach (config('app.langages') as $locale) {
            $rules["translations.$locale.data"] = ['nullable', 'json'];
        }

        return $rules;
    }
}
