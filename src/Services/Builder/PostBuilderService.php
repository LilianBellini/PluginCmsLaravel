<?php

namespace LilianBellini\PluginCmsLaravel\Services\Builder;

use Illuminate\Support\Str;
use LilianBellini\PluginCmsLaravel\Models\Post\Post;
use LilianBellini\PluginCmsLaravel\Models\Post\PostTranslation;
use LilianBellini\PluginCmsLaravel\Models\Admin\Seo\SeoProfile;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;

class PostBuilderService
{
    /**
     * Crée un article (Post + PostTranslation) à partir d'un contenu HTML.
     *
     * @param string $html
     * @param int $categoryId
     * @param int $userId
     * @param string $locale
     * @return Post
     */
    public function createFromHtml(string $html): Post
    {
        $userId = 1;
        $locale = 'fr';
        $html = $this->cleanHtmlContent($html);
        // Récupération de la catégorie et des tags via GPT
        $taxonomy = $this->suggestAndResolveCategoryAndTags($html);
        $categoryId = $taxonomy['category_id'];
        $tagIds = $taxonomy['tag_ids'];

        // Extraction et suppression du <h1>
        [$title, $html] = $this->extractH1($html); // modifie $html par référence
        $slug = Str::slug($title);

        $existingTranslation = PostTranslation::where('slug', $slug)
            ->where('locale', $locale)
            ->first();

        if ($existingTranslation) {
            // Retourne le Post existant sans rien faire
            return $existingTranslation->post;
        }
        
        // Génération d'une image basée sur le titre
        $image = $this->generateImageForArticle($title);

        // Création du Post principal
        $post = Post::create([
            'category_id' => $categoryId,
            'image' => $image,
            'user_id' => $userId,
            'status' => true,
            // 'image' => $image,
        ]);

        // Création de la traduction
        $post->translations()->create([
            'locale' => $locale,
            'title' => $title,
            'slug' => $slug,
            'excerpt' => PostTranslation::generateExcerpt($html),
            'content' => $html,
        ]);


        // Association des tags
        if (!empty($tagIds)) {
            $post->tags()->sync($tagIds);
        }


        return $post;
    }


    /**
     * Extrait le premier <h1> du HTML pour l'utiliser comme titre.
     *
     * @param string $html
     * @return string
     */
    private function extractH1(string &$html): array
    {
        // Cherche le premier <h1> et l'extrait
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $html, $matches)) {
            $title = trim(strip_tags($matches[1]));

            // Supprime le <h1> du HTML d'origine
            $html = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $html, 1);
        }

        return [$title, $html];
    }


    public function generateImageForArticle(string $title): ?string
    {
        // On récupère le prompt personnalisé depuis le profil SEO
        $stylePrompt = SeoProfile::first()?->image_style_prompt
            ?? "Style moderne, épuré, adapté à un site B2B tech.";

        // Génère l'image avec OpenAI
        $imageResponse = OpenAI::images()->create([
            'prompt' => "Illustration professionnelle pour un article intitulé : \"$title\". " . $stylePrompt,
            'n' => 1,
            'model' => 'dall-e-3',
            'size' => '1024x1024',
        ]);

        $imageUrl = $imageResponse['data'][0]['url'] ?? null;

        if ($imageUrl) {
            $imageContents = file_get_contents($imageUrl);

            $filename = 'images/posts/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $imageContents);

            return $filename; // stocké dans public/images/posts/ → accessible via asset('storage/' . $filename)
        }

        return null;
    }


    public function suggestAndResolveCategoryAndTags(string $html): array
    {

        $existingCategories = \LilianBellini\PluginCmsLaravel\Models\Post\CategoryTranslation::where('locale', 'fr')->pluck('name')->all();
        $existingTags = \LilianBellini\PluginCmsLaravel\Models\Post\TagTranslation::where('locale', 'fr')->pluck('name')->all();

        $categoriesList = implode(', ', $existingCategories);
        $tagsList = implode(', ', $existingTags);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<SYS
        Tu es un assistant de classification pour un CMS. Ton rôle est d’attribuer à un article :
        
        - Une seule **catégorie principale**,
        - Et jusqu’à **4 tags maximum**.
        
        🧠 Utilise **de préférence les catégories et tags déjà existants**.
        
        Catégories disponibles :
        $categoriesList
        
        Tags disponibles :
        $tagsList
        
        Si aucune catégorie ou tag ne correspond, choisis ce qui s’en rapproche le plus. N’invente rien de nouveau sauf en dernier recours.
        Retourne uniquement un JSON de ce format : 
        { "categorie": "Nom exact", "tags": ["Tag 1", "Tag 2", ...] }
        SYS
                ],
                [
                    'role' => 'user',
                    'content' => "Voici un article HTML : \n\n$html",
                ],
            ],
        ]);


        $content = $response['choices'][0]['message']['content'] ?? '';
        $parsed = json_decode($content, true);

        $categoryName = $parsed['categorie'] ?? 'Général';
        $tagNames = isset($parsed['tags']) && is_array($parsed['tags']) ? $parsed['tags'] : [];

        // 🔍 Récupération ou création de la catégorie via la translation
        $categoryTranslation = \LilianBellini\PluginCmsLaravel\Models\Post\CategoryTranslation::where('locale', 'fr')
            ->where('name', $categoryName)
            ->first();

        if ($categoryTranslation) {
            $category = $categoryTranslation->category;
        } else {
            $category = \LilianBellini\PluginCmsLaravel\Models\Post\Category::create(['user_id' => auth()->id() ?? 1]);
            $category->translations()->create([
                'locale' => 'fr',
                'name' => $categoryName,
                'slug' => str()->slug($categoryName),
            ]);
        }

        // 🔍 Récupération ou création des tags via translation
        $tagIds = [];
        foreach ($tagNames as $name) {
            $tagTranslation = \LilianBellini\PluginCmsLaravel\Models\Post\TagTranslation::where('locale', 'fr')
                ->where('name', $name)
                ->first();

            if ($tagTranslation) {
                $tagIds[] = $tagTranslation->tag_id;
            } else {
                $tag = \LilianBellini\PluginCmsLaravel\Models\Post\Tag::create();
                $tag->translations()->create([
                    'locale' => 'fr',
                    'name' => $name,
                ]);
                $tagIds[] = $tag->id;
            }
        }

        return [
            'category_id' => $category->id,
            'tag_ids' => $tagIds,
        ];
    }

    public function cleanHtmlContent(string $html): string
    {
        // Supprime les blocs ``` ou ```html ou ```php etc.
        $html = preg_replace('/```[a-z]*\\n?/i', '', $html); // supprime les ```html ou ```php
        $html = str_replace('```', '', $html); // supprime les ``` restants

        // Nettoyage des listes
        $html = preg_replace('/<ul>\s*/i', '', $html);
        $html = preg_replace('/<\/ul>/i', '', $html);

        // Supprime tous les <br> et \n
        $html = preg_replace('/<br\s*\/?>/i', '', $html);
        $html = str_replace("\n", '', $html);

        // Trim global
        return trim($html);
    }

}
