<?php

namespace LilianBellini\PluginCmsLaravel\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'boolean'],
            'image' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120', Rule::requiredIf(!$this->post)],
            'tags' => ['exists:tags,id'],
            'user_id' => ['required', 'exists:users,id']
        ];
        $post = $this->route('post'); // ou selon votre logique pour obtenir l'ID de la catégorie
        foreach ($this->input('translations', []) as $locale => $translation) {
            $translationId = $post ? $post->getTranslation($locale)->id : 0;
            $rules["translations.$locale.title"] = ['required', 'string', 'max:255'];
            $rules["translations.$locale.content"] = ['required', 'string'];
            $rules["translations.$locale.excerpt"] = ['nullable', 'string', 'max:255'];
            $rules["translations.$locale.slug"] = [
                'required',
                'string',
                'max:255',
                Rule::unique('post_translations', 'slug')->ignore($translationId)

            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'category_id.required' => 'Le champ catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée est invalide.',
            'status.required' => 'Le champ statut est obligatoire.',
            'status.boolean' => 'Le statut doit être vrai ou faux.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être un fichier de type : jpeg, png, jpg, webp.',
            'image.max' => 'L\'image ne doit pas dépasser 5120 kilobytes.',
            'tags.exists' => 'Les tags sélectionnés sont invalides.',
            'user_id.required' => 'Le champ utilisateur est obligatoire.',
            'user_id.exists' => 'L\'utilisateur sélectionné est invalide.',
        ];

        foreach ($this->input('translations', []) as $locale => $translation) {
            $messages["translations.$locale.title.required"] = 'Le champ titre ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.title.string"] = 'Le titre ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.title.max"] = 'Le titre ' . $locale . ' ne doit pas dépasser 255 caractères.';
            $messages["translations.$locale.content.required"] = 'Le champ contenu ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.content.string"] = 'Le contenu ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.excerpt.string"] = 'L\'extrait ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.excerpt.max"] = 'L\'extrait ' . $locale . ' ne doit pas dépasser 255 caractères.';
            $messages["translations.$locale.slug.required"] = 'Le champ slug ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.slug.string"] = 'Le slug ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.slug.max"] = 'Le slug ' . $locale . ' ne doit pas dépasser 255 caractères.';
            $messages["translations.$locale.slug.unique"] = 'Le slug ' . $locale . ' est déjà pris.';
        }

        return $messages;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
