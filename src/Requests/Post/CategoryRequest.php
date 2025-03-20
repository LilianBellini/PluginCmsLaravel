<?php

namespace LilianBellini\PluginCmsLaravel\Requests\Post;

use App\Rules\Authcheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'user_id' => ['required', 'exists:users,id'],
        ];
    
        // Assurez-vous de récupérer l'ID de la catégorie ou de la traduction en cours, si existant
        $category = $this->route('category'); // ou selon votre logique pour obtenir l'ID de la catégorie
        $categoryId = $category ? $category->id : 0;
        foreach (config('app.langages') as $locale) {
            $rules["translations.$locale.name"] = 'required|string|max:255';
            $rules["translations.$locale.slug"] = [
                'required',
                'string',
                'max:255',
                Rule::unique('category_translations', 'slug')
                    ->ignore($categoryId, 'category_id')
            ];
        }
    
        return $rules;
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        $messages = [];

        foreach (config('app.langages') as $locale) {
            $messages["translations.$locale.name.required"] = "Le nom en " . strtoupper($locale) . " est requis.";
            $messages["translations.$locale.name.string"] = "Le nom en " . strtoupper($locale) . " doit être une chaîne de caractères.";
            $messages["translations.$locale.name.max"] = "Le nom en " . strtoupper($locale) . " ne peut pas dépasser 255 caractères.";
            $messages["translations.$locale.slug.required"] = "Le slug en " . strtoupper($locale) . " est requis.";
            $messages["translations.$locale.slug.string"] = "Le slug en " . strtoupper($locale) . " doit être une chaîne de caractères.";
            $messages["translations.$locale.slug.max"] = "Le slug en " . strtoupper($locale) . " ne peut pas dépasser 255 caractères.";
            $messages["translations.$locale.slug.unique"] = "Le slug en " . strtoupper($locale) . " doit être unique.";

        }

        return $messages;
    }
}
