<?php

namespace LilianBellini\PluginCmsLaravel\Services\Generate;

use LilianBellini\PluginCmsLaravel\Enums\ArticleType;
use LilianBellini\PluginCmsLaravel\Models\Admin\Seo\SeoProfile;
use LilianBellini\PluginCmsLaravel\Services\SearchConsoleService;
use LilianBellini\PluginCmsLaravel\Services\Builder\PostBuilderService;
use LilianBellini\PluginCmsLaravel\Prompts\Posts\PostSeoPrompt;
use LilianBellini\PluginCmsLaravel\Prompts\Posts\PostNewsPrompt;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Arr;

class GeneratePostService
{
    public function __construct(
        protected SearchConsoleService $searchConsoleService,
        protected PostBuilderService $postBuilderService,
        protected GenerateContextService $generateContext,
    ) {}

    /**
     * Point d’entrée appelé par le scheduler.
     */
    public function generateArticle(?ArticleType $type = null)
    {
        $type ??= $this->pickTypeByRatio();

        // Contexte complet, adapté au type d’article
        $context = $this->generateContext($type);
        // Construction du prompt
        $prompt = match ($type) {
            ArticleType::SEO => (new PostSeoPrompt())->build($context),
            ArticleType::NEWS => (new PostNewsPrompt())->build($context),
        };

        // Appel à OpenAI
        $html = $this->callOpenAi($prompt, $type);

        // Création de l’article
        return $this->postBuilderService->createFromHtml($html);
    }

    protected function pickTypeByRatio(): ArticleType
    {
        $ratio = SeoProfile::first()?->article_mix_ratio ?? 70;
        return random_int(1, 100) <= $ratio ? ArticleType::SEO : ArticleType::NEWS;
    }

    protected function generateContext(ArticleType $type): array
    {
        return match ($type) {
            ArticleType::SEO => $this->generateContext->forArticle(),
            ArticleType::NEWS => $this->generateContext->forArticle(),
        };
    }

    protected function callOpenAi(string $prompt, ArticleType $type): ?string
    {
        set_time_limit(config('openai.request_timeout', 30));

        $model = $type === ArticleType::NEWS ? 'gpt-4o-search-preview' : 'gpt-4o-mini';

        $response = OpenAI::chat()->create([
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => 'Tu es un expert en rédaction SEO et stratégie de contenu.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return Arr::get($response, 'choices.0.message.content');
    }
}
