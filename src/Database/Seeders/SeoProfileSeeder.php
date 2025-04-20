<?php

namespace LilianBellini\PluginCmsLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use LilianBellini\PluginCmsLaravel\Models\Admin\Seo\SeoProfile;

class SeoProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoProfile::create([
            'company_name' => 'Votre entreprise',
            'positioning' => 'Nous accompagnons les entreprises dans la création de contenus pertinents et cohérents grâce à l’intelligence artificielle et à des outils sur mesure.',
            'values' => ['innovation', 'clarté', 'efficacité', 'éthique'],
            'target_clients' => ['PME', 'grandes entreprises', 'équipes marketing', 'agences de communication'],
            'locations' => ['France', 'Belgique', 'Suisse'],
            'tone' => 'Professionnel, accessible, structuré, avec une touche humaine',
            'priority_themes' => ['SEO local', 'contenu evergreen', 'automatisation éditoriale', 'visibilité digitale'],
            'blacklist' => ['buzzword', 'hyperbole', 'expressions trop vagues'],
            'image_style_prompt' => 'Illustration moderne, minimaliste, avec des couleurs douces et un style vectoriel',
            'auto_publish_enabled' => false,
            'generation_frequency' => 'weekly',
            'auto_publish_generated_article' => false,
            'article_mix_ratio' => 50,
        ]);
    }
}
