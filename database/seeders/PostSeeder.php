<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lilian\PluginCmsLaravel\Models\Post\Post;
use Lilian\PluginCmsLaravel\Models\Post\PostTranslation;
use Lilian\PluginCmsLaravel\Models\Post\Tag;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'image' => 'seed/posts/mantes.jpg',
                'category_id' => 1,
                'user_id' => 1,
                'status' => true,
                'translations' => [
                    'fr' => [
                        'title' => 'Falcon Racing présent au Criterium Longue Distance',
                        'content' => 'Falcon Racing, dirigé par Michel et Katia Andrieux, sera présent au Criterium Longue Distance. Cet événement se tiendra au Havre du Robert, France, du 5 au 6 juillet 2024. C\'est l\'occasion parfaite pour découvrir et tester du matériel d\'aviron de compétition neuf et d\'occasion. Falcon Racing propose des options de location et d\'achat pour répondre à tous vos besoins.',
                        'excerpt' => Post::generateExcerpt('Falcon Racing, dirigé par Michel et Katia Andrieux, sera présent au Criterium Longue Distance. Cet événement se tiendra au Havre du Robert, France, du 5 au 6 juillet 2024.'),
                        'slug' => Str::slug('Falcon Racing présent au Criterium Longue Distance'),
                    ],
                    'en' => [
                        'title' => 'Falcon Racing present at the Long Distance Criterium',
                        'content' => 'Falcon Racing, led by Michel and Katia Andrieux, will be present at the Long Distance Criterium. This event will take place at Havre du Robert, France, from July 5 to 6, 2024. It\'s the perfect opportunity to discover and test new and used competition rowing equipment. Falcon Racing offers rental and purchase options to meet all your needs.',
                        'excerpt' => Post::generateExcerpt('Falcon Racing, led by Michel and Katia Andrieux, will be present at the Long Distance Criterium. This event will take place at Havre du Robert, France, from July 5 to 6, 2024.'),
                        'slug' => Str::slug('Falcon Racing present at the Long Distance Criterium'),
                    ],
                ]
            ],
            [
                'image' => 'seed/posts/vichy.jpg',
                'category_id' => 1,
                'user_id' => 1,
                'status' => true,
                'translations' => [
                    'fr' => [
                        'title' => 'Falcon Racing aux Championnats de France J16',
                        'content' => 'Michel et Katia Andrieux de Falcon Racing seront présents aux Championnats de France J16 et Criterium Handi-Valide J16. Rendez-vous au Lac D\'allier, France, du 4 au 5 juillet 2024. Falcon Racing offre une gamme complète de matériel d\'aviron de compétition à louer ou à acheter, en neuf comme en occasion.',
                        'excerpt' => Post::generateExcerpt('Michel et Katia Andrieux de Falcon Racing seront présents aux Championnats de France J16 et Criterium Handi-Valide J16. Rendez-vous au Lac D\'allier, France, du 4 au 5 juillet 2024.'),
                        'slug' => Str::slug('Falcon Racing aux Championnats de France J16'),
                    ],
                    'en' => [
                        'title' => 'Falcon Racing at the French J16 Championships',
                        'content' => 'Michel and Katia Andrieux from Falcon Racing will be present at the French J16 Championships and J16 Handi-Valid Criterium. Join us at Lac D\'allier, France, from July 4 to 5, 2024. Falcon Racing offers a full range of competition rowing equipment for rent or purchase, both new and used.',
                        'excerpt' => Post::generateExcerpt('Michel and Katia Andrieux from Falcon Racing will be present at the French J16 Championships and J16 Handi-Valid Criterium. Join us at Lac D\'allier, France, from July 4 to 5, 2024.'),
                        'slug' => Str::slug('Falcon Racing at the French J16 Championships'),
                    ],
                ]
            ],
            [
                'image' => 'seed/posts/libourne.jpg',
                'category_id' => 1,
                'user_id' => 1,
                'status' => true,
                'translations' => [
                    'fr' => [
                        'title' => 'Falcon Racing à la Régate de Sélection U19 et U23',
                        'content' => 'La régate de sélection U19 et U23 - Étape 2, qui se déroulera au Bassin du Breuil, France, les 29 et 30 juin 2024, accueillera Falcon Racing. Sous la direction de Michel et Katia Andrieux, Falcon Racing vous propose de louer ou d\'acheter du matériel d\'aviron de compétition.',
                        'excerpt' => Post::generateExcerpt('La régate de sélection U19 et U23 - Étape 2, qui se déroulera au Bassin du Breuil, France, les 29 et 30 juin 2024, accueillera Falcon Racing.'),
                        'slug' => Str::slug('Falcon Racing à la Régate de Sélection U19 et U23'),
                    ],
                    'en' => [
                        'title' => 'Falcon Racing at the U19 and U23 Selection Regatta',
                        'content' => 'The U19 and U23 selection regatta - Stage 2, which will take place at Bassin du Breuil, France, on June 29 and 30, 2024, will host Falcon Racing. Led by Michel and Katia Andrieux, Falcon Racing offers you the opportunity to rent or purchase competition rowing equipment.',
                        'excerpt' => Post::generateExcerpt('The U19 and U23 selection regatta - Stage 2, which will take place at Bassin du Breuil, France, on June 29 and 30, 2024, will host Falcon Racing.'),
                        'slug' => Str::slug('Falcon Racing at the U19 and U23 Selection Regatta'),
                    ],
                ]
            ],
            [
                'image' => 'seed/posts/rouen.jpg',
                'category_id' => 1,
                'user_id' => 1,
                'status' => true,
                'translations' => [
                    'fr' => [
                        'title' => 'Falcon Racing au Championnat National Jeune',
                        'content' => 'Falcon Racing sera présent au Championnat National Jeune et Criterium Handi-Valide Jeune, qui se déroulera au Bassin du Breuil, France, du 28 au 30 juin 2024. Michel et Katia Andrieux vous proposent une large sélection de matériel d\'aviron de compétition à louer ou à acheter.',
                        'excerpt' => Post::generateExcerpt('Falcon Racing sera présent au Championnat National Jeune et Criterium Handi-Valide Jeune, qui se déroulera au Bassin du Breuil, France, du 28 au 30 juin 2024.'),
                        'slug' => Str::slug('Falcon Racing au Championnat National Jeune'),
                    ],
                    'en' => [
                        'title' => 'Falcon Racing at the National Youth Championship',
                        'content' => 'Falcon Racing will be present at the National Youth Championship and Youth Handi-Valid Criterium, which will take place at Bassin du Breuil, France, from June 28 to 30, 2024. Michel and Katia Andrieux offer you a wide selection of competition rowing equipment for rent or purchase.',
                        'excerpt' => Post::generateExcerpt('Falcon Racing will be present at the National Youth Championship and Youth Handi-Valid Criterium, which will take place at Bassin du Breuil, France, from June 28 to 30, 2024.'),
                        'slug' => Str::slug('Falcon Racing at the National Youth Championship'),
                    ],
                ]
            ],
        ];

        foreach ($posts as $postData) {
            $translations = $postData['translations'];
            unset($postData['translations']);

            $post = Post::create($postData);

            foreach ($translations as $locale => $translationData) {
                $translationData['locale'] = $locale;
                $translationData['post_id'] = $post->id;
                PostTranslation::create($translationData);
            }

            // Récupérer tous les tags
            $tags = Tag::all();

            // Sélectionner aléatoirement 2 ou 3 tags
            $randomTags = $tags->random(rand(2, 3));

            // Attacher les tags au post
            $post->tags()->attach($randomTags);
        }
    }
}
