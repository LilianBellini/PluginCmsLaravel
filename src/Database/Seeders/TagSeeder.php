<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use LilianBellini\PluginCmsLaravel\Models\Post\Tag;
use LilianBellini\PluginCmsLaravel\Models\Post\TagTranslation;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            [
                'translations' => [
                    'fr' => ['name' => 'Falcon Racing'],
                    'en' => ['name' => 'Falcon Racing'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Compétition'],
                    'en' => ['name' => 'Competition'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Aviron'],
                    'en' => ['name' => 'Rowing'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Équipement'],
                    'en' => ['name' => 'Equipment'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Régate'],
                    'en' => ['name' => 'Regatta'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Handi-Valide'],
                    'en' => ['name' => 'Handi-Valid'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Jeune'],
                    'en' => ['name' => 'Youth'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Master'],
                    'en' => ['name' => 'Master'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Innovation'],
                    'en' => ['name' => 'Innovation'],
                ],
            ],
            [
                'translations' => [
                    'fr' => ['name' => 'Nouveautés'],
                    'en' => ['name' => 'News'],
                ],
            ],
        ];

        foreach ($tags as $tagData) {
            $translations = $tagData['translations'];
            unset($tagData['translations']);

            $tag = Tag::create();

            foreach ($translations as $locale => $translationData) {
                $translationData['locale'] = $locale;
                $translationData['tag_id'] = $tag->id;
                TagTranslation::create($translationData);
            }
        }
    }
}
