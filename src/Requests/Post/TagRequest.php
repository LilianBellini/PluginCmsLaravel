<?php
namespace LilianBellini\PluginCmsLaravel\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        $tag = $this->route('tag');
        $tagId = $tag ? $tag->id : 0;

        foreach (config('app.langages') as $locale) {
            $rules["translations.$locale.name"] = [
                'required',
                'string',
                'max:255',
                Rule::unique('tag_translations', 'name')
                ->ignore($tagId, 'tag_id')
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach (config('app.langages') as $locale) {
            $messages["translations.$locale.name.required"] = "Le nom en " . strtoupper($locale) . " est requis.";
            $messages["translations.$locale.name.string"] = "Le nom en " . strtoupper($locale) . " doit être une chaîne de caractères.";
            $messages["translations.$locale.name.max"] = "Le nom en " . strtoupper($locale) . " ne peut pas dépasser 255 caractères.";
            $messages["translations.$locale.name.unique"] = "Le nom en " . strtoupper($locale) . " doit être unique.";
        }

        return $messages;
    }
}
