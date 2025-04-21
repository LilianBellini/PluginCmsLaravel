<?php

namespace LilianBellini\PluginCmsLaravel\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreSectorRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        $rules = [];
        foreach (config('app.langages') as $locale) {
            $rules["translations.$locale.name"] = 'required|string';
            $rules["translations.$locale.slug"] = 'required|string';
        }
        return $rules;
    }
}
