<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use LilianBellini\PluginCmsLaravel\Models\Post\Category;
use LilianBellini\PluginCmsLaravel\Models\Post\CategoryTranslation;
use App\Models\User; // Assurez-vous d'importer le bon modèle User

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Récupérer le premier utilisateur disponible
        $user = User::first();
        $userId = $user ? $user->id : null; // Si aucun utilisateur n'existe, $userId sera null

        $categories = [
            [
                'user_id' => $userId,
                'translations' => [
                    'fr' => [
                        'name' => 'Actualités de la marque',
                        'slug' => 'actualites-de-la-marque',
                    ],
                    'en' => [
                        'name' => 'Brand News',
                        'slug' => 'brand-news',
                    ],
                ],
            ],
            [
                'user_id' => $userId,
                'translations' => [
                    'fr' => [
                        'name' => 'Nouveautés Falcon',
                        'slug' => 'nouveautes-falcon',
                    ],
                    'en' => [
                        'name' => 'Falcon News',
                        'slug' => 'falcon-news',
                    ],
                ],
            ],
            [
                'user_id' => $userId,
                'translations' => [
                    'fr' => [
                        'name' => 'Régates',
                        'slug' => 'regates',
                    ],
                    'en' => [
                        'name' => 'Regattas',
                        'slug' => 'regattas',
                    ],
                ],
            ],
            [
                'user_id' => $userId,
                'translations' => [
                    'fr' => [
                        'name' => 'Divers',
                        'slug' => 'divers',
                    ],
                    'en' => [
                        'name' => 'Miscellaneous',
                        'slug' => 'miscellaneous',
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $translations = $categoryData['translations'];
            unset($categoryData['translations']);

            // Vérification si user_id est null (dans le cas où aucun utilisateur n'existe encore)
            if ($categoryData['user_id'] === null) {
                continue; // On ignore cette insertion pour éviter une erreur
            }

            $category = Category::create($categoryData);

            foreach ($translations as $locale => $translationData) {
                $translationData['locale'] = $locale;
                $translationData['category_id'] = $category->id;
                CategoryTranslation::create($translationData);
            }
        }
    }
}
