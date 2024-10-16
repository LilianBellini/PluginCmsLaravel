<?php

namespace Lilian\PluginCmsLaravel\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     *
     * @return bool
     */
    public function authorize()
    {
        // Vous pouvez ajuster cela en fonction de vos règles d'autorisation
        return true;
    }

    /**
     * Récupère les règles de validation qui s'appliquent à la requête.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'about' => 'required|string|max:255',
            'copy_rights' => 'required|string|max:255',
            'url_insta' => 'required|url',
            'url_twitter' => 'required|url',
            'url_linkedin' => 'required|url',
            'url_fb' => 'required|url',
            'contact_email' => 'required|email|max:255',
        ];
    }

    /**
     * Messages de validation personnalisés.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'site_name.required' => 'Le nom du site est obligatoire.',
            'description.required' => 'La description du site est obligatoire.',
            'about.required' => 'La section À propos est obligatoire.',
            'copy_rights.required' => 'La mention de droit d\'auteur est obligatoire.',
            'url_insta.required' => 'L\'URL Instagram est obligatoire.',
            'url_twitter.required' => 'L\'URL Twitter est obligatoire.',
            'url_linkedin.required' => 'L\'URL LinkedIn est obligatoire.',
            'url_fb.required' => 'L\'URL Facebook est obligatoire.',
            'contact_email.required' => 'L\'adresse email de contact est obligatoire.',
            'url_insta.url' => 'Le format de l\'URL Instagram est invalide.',
            'url_twitter.url' => 'Le format de l\'URL Twitter est invalide.',
            'url_linkedin.url' => 'Le format de l\'URL LinkedIn est invalide.',
            'url_fb.url' => 'Le format de l\'URL Facebook est invalide.',
            'contact_email.email' => 'L\'adresse email doit être valide.',
        ];
    }
}
