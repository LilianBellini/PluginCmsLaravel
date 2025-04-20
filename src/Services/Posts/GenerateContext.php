<?php
namespace LilianBellini\PluginCmsLaravelServices\Posts;

use App\Services\Seo\Data\ArticleDataFetcher;
use App\Services\Seo\Prompt\SeoPromptBuilder;
use App\Services\Seo\Prompt\NewsPromptBuilder;
use App\Enums\ArticleType;
use App\Services\ArticleCreationService;
use OpenAI\Laravel\Facades\OpenAI;

class GenerateContext
{
    public function __construct(
        protected ArticleDataFetcher $dataFetcher,
        protected SeoPromptBuilder $seoPromptBuilder,
        protected NewsPromptBuilder $newsPromptBuilder,
        protected ArticleCreationService $articleService,
    ) {}


    public function buildContext(): array
{
    $profile = $this->dataFetcher->getSeoProfile();
    $analytics = $this->dataFetcher->getAnalytics();
    $existingTitles = $this->dataFetcher->getExistingTitles();

    $internalLinks = PostTranslation::where('locale', 'fr')
        ->get()
        ->map(fn($post) => "- {$post->title} : https://flowpi.fr/actualites/{$post->slug}")
        ->implode("\n");

    $lastTitles = PostTranslation::where('locale', 'fr')
        ->orderByDesc('created_at')
        ->take(5)
        ->pluck('title')
        ->toArray();

    return [
        'metrics' => $analytics['metrics'],
        'formatted_opportunities' => collect($analytics['opportunities'])->map(fn($q, $i) =>
            ($i + 1) . ". \"{$q['query']}\" (URL : {$q['page']}) – {$q['impressions']} impressions, CTR {$q['ctr']}%, position {$q['position']}"
        )->implode("\n"),

        'formatted_top_queries' => collect($analytics['top_queries'])->map(fn($q, $i) =>
            ($i + 1) . ". \"{$q['query']}\" (URL : {$q['page']}) – {$q['clicks']} clics, CTR {$q['ctr']}%, position {$q['position']}"
        )->implode("\n"),

        'formatted_raw_queries' => collect($analytics['raw'])->map(fn($q, $i) =>
            ($i + 1) . ". \"{$q['query']}\" (URL : {$q['page']}) – {$q['impressions']} impressions, CTR {$q['ctr']}%, position {$q['position']}"
        )->implode("\n"),

        'profile' => [
            'company_name' => $profile->company_name,
            'positioning' => $profile->positioning,
            'values' => implode(', ', $profile->values ?? []),
            'target_clients' => implode(', ', $profile->target_clients ?? []),
            'locations' => implode(', ', $profile->locations ?? []),
            'tone' => $profile->tone,
            'priority_themes' => implode(', ', $profile->priority_themes ?? []),
            'blacklist' => implode(', ', $profile->blacklist ?? []),
        ],

        'existing_titles' => count($existingTitles) ? "- " . implode("\n- ", $existingTitles) : 'Aucun',
        'last_titles' => count($lastTitles) ? "- " . implode("\n- ", $lastTitles) : 'Aucun',
        'internal_links' => $internalLinks,
    ];
}

}
