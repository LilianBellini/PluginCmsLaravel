<?php

namespace LilianBellini\PluginCmsLaravel\Services\Generate;

use LilianBellini\PluginCmsLaravel\Models\Admin\Seo\SeoProfile;
use LilianBellini\PluginCmsLaravel\Models\Admin\Google\GoogleApiCredential;
use LilianBellini\PluginCmsLaravel\Services\SearchConsoleService;
use LilianBellini\PluginCmsLaravel\Models\Post\PostTranslation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class GenerateContextService
{
    public function __construct(
        protected SearchConsoleService $searchConsoleService
    ) {}

    public function forArticle(): array
    {
        $seoProfile = SeoProfile::firstOrFail();
        $analytics = $this->fetchAnalytics();
        $existingTitles = $this->getExistingTitles();

        return [
            'metrics' => $analytics['metrics'] ?? [
                'total_queries' => 0,
                'total_impressions' => 0,
                'avg_ctr' => 0,
                'median_position' => 0,
            ],

            'formatted_opportunities' => $this->formatQueries($analytics['opportunities'] ?? collect()),
            'formatted_top_queries' => $this->formatQueries($analytics['top_queries'] ?? collect(), true),
            'formatted_raw_queries' => $this->formatQueries(collect($analytics['raw'] ?? [])),

            'profile' => [
                'company_name' => $seoProfile->company_name,
                'positioning' => $seoProfile->positioning,
                'values' => $this->stringifyArray($seoProfile->values),
                'target_clients' => $this->stringifyArray($seoProfile->target_clients),
                'locations' => $this->stringifyArray($seoProfile->locations),
                'tone' => $seoProfile->tone,
                'priority_themes' => $this->stringifyArray($seoProfile->priority_themes),
                'blacklist' => $this->stringifyArray($seoProfile->blacklist),
            ],

            'existing_titles' => $this->stringifyList($existingTitles),

            'internal_links' => PostTranslation::where('locale', 'fr')
                ->get()
                ->map(fn ($post) => "- {$post->title} : https://flowpi.fr/actualites/{$post->slug}")
                ->implode("\n"),

            'last_titles' => $this->stringifyList(
                PostTranslation::where('locale', 'fr')
                    ->latest()
                    ->take(5)
                    ->pluck('title')
                    ->toArray()
            ),
        ];
    }

    protected function fetchAnalytics(): array
    {
        $credential = GoogleApiCredential::first();
        if (! $credential) return [];

        $siteUrl = 'sc-domain:' . $credential->site_url;
        $endDate = Carbon::today()->toDateString();
        $startDate = Carbon::today()->subYear()->toDateString();

        return $this->searchConsoleService->getSearchOpportunities($siteUrl, $startDate, $endDate);
    }

    protected function getExistingTitles(): array
    {
        return PostTranslation::where('locale', 'fr')
            ->latest()
            ->take(20)
            ->pluck('title')
            ->toArray();
    }

    protected function formatQueries(Collection $queries, bool $isClickBased = false): string
    {
        return $queries->map(function ($q, $i) use ($isClickBased) {
            $line = ($i + 1) . ". \"{$q['query']}\" (URL : {$q['page']})";
            if ($isClickBased) {
                return "$line – {$q['clicks']} clics, CTR {$q['ctr']}%, position {$q['position']}";
            }
            return "$line – {$q['impressions']} impressions, CTR {$q['ctr']}%, position {$q['position']}";
        })->implode("\n");
    }

    protected function stringifyArray(?array $arr): string
    {
        return $arr ? implode(', ', $arr) : 'Non renseigné';
    }

    protected function stringifyList(array $list): string
    {
        return count($list) ? "- " . implode("\n- ", $list) : 'Aucun';
    }
}
