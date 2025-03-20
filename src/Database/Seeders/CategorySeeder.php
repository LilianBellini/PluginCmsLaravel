<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use LilianBellini\PluginCmsLaravel\Models\Post\Category;
use LilianBellini\PluginCmsLaravel\Models\Post\CategoryTranslation;


class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'user_id' => 1,
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
                'user_id' => 1,
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
                'user_id' => 1,
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
                'user_id' => 1,
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

            $category = Category::create($categoryData);

            foreach ($translations as $locale => $translationData) {
                $translationData['locale'] = $locale;
                $translationData['category_id'] = $category->id;
                CategoryTranslation::create($translationData);
            }
        }
    }
}
