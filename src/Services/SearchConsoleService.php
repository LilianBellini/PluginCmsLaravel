<?php

namespace LilianBellini\PluginCmsLaravel\Services;

use Google_Client;
use Google_Service_Webmasters;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest;
use LilianBellini\PluginCmsLaravel\Models\Admin\Google\GoogleApiCredential;

class SearchConsoleService
{
    protected Google_Client $client;

    public function __construct()
    {
        $credentials = GoogleApiCredential::firstOrFail();
        $this->client = new Google_Client();
        $this->client->setClientId($credentials->client_id);
        $this->client->setClientSecret($credentials->client_secret);
        $this->client->setRedirectUri(config('app.url') . '/google/callback');
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');

        $this->client->addScope([
            'https://www.googleapis.com/auth/webmasters.readonly',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ]);

        if ($credentials->token) {
            $this->client->setAccessToken($credentials->token);

            if ($this->client->isAccessTokenExpired()) {
                if ($refreshToken = $this->client->getRefreshToken()) {
                    $newToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                    $credentials->token = $newToken;
                    $credentials->save();
                    $this->client->setAccessToken($newToken);
                }
            }
        }
    }


    public function updateClient(): Google_Client
    {
        if (session()->has('access_token')) {
            $token = session('access_token');

            if (is_string($token)) {
                $token = json_decode($token, true);
            }

            $this->client->setAccessToken($token);

            if ($this->client->isAccessTokenExpired()) {
                if ($refresh = $this->client->getRefreshToken()) {
                    $newToken = $this->client->fetchAccessTokenWithRefreshToken($refresh);
                    session(['access_token' => $newToken]);
                }
            }
        }

        return $this->client;
    }

    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    public function handleCallback(string $code): void
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);

        if (!isset($token['access_token'])) {
            throw new \Exception('Token non valide');
        }

        // On enregistre dans la base
        $oauth = new \Google_Service_Oauth2($this->client);
        $user = $oauth->userinfo->get();

        $credentials = GoogleApiCredential::firstOrFail();
        $credentials->token = $token;
        $credentials->email = $user->getEmail();
        $credentials->save();
    }

    public function testCredentials(): bool
    {
        try {
            $this->updateClient();
            $oauth = new \Google_Service_Oauth2($this->client);
            $user = $oauth->userinfo->get();

            return !!$user->getEmail();
        } catch (\Exception $e) {
            return false;
        }
    }


    public function getAnalytics(string $siteUrl, string $startDate, string $endDate)
    {

        $this->updateClient();
        $service = new Google_Service_Webmasters($this->client);

        $request = new Google_Service_Webmasters_SearchAnalyticsQueryRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'dimensions' => ['query'],
            'rowLimit' => 1000,
        ]);


        $response = $service->searchanalytics->query($siteUrl, $request);

        return collect($response->getRows())->map(function ($row) {
            return [
                'query' => $row->getKeys()[0],
                'clicks' => $row->getClicks(),
                'impressions' => $row->getImpressions(),
                'ctr' => $row->getCtr(),
                'position' => $row->getPosition(),
            ];
        });
    }

    public function getSearchOpportunities(string $siteUrl, string $startDate, string $endDate): array
    {
        $this->updateClient();
        $service = new \Google_Service_Webmasters($this->client);
    
        $request = new \Google_Service_Webmasters_SearchAnalyticsQueryRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'dimensions' => ['query', 'page'],
            'rowLimit' => 2500,
        ]);
    
        $response = $service->searchanalytics->query($siteUrl, $request);
    
        $data = collect($response->getRows())->map(function ($row) {
            return [
                'query' => $row->getKeys()[0],
                'page' => $row->getKeys()[1] ?? null,
                'clicks' => $row->getClicks(),
                'impressions' => $row->getImpressions(),
                'ctr' => round($row->getCtr() * 100, 2), // en %
                'position' => round($row->getPosition(), 2),
            ];
        });
    
        if ($data->isEmpty()) {
            return [
                'profile' => 'no_data',
                'metrics' => [],
                'opportunities' => collect(),
                'top_queries' => collect(),
                'raw' => $data,
            ];
        }
    
        // Calculs des métriques globales
        $avgImpressions = round($data->avg('impressions'), 2);
        $avgCTR = round($data->avg('ctr'), 2);
        $medianPosition = $data->median('position');
        $totalQueries = $data->count();
        $totalImpressions = $data->sum('impressions');
        $avgClicks = round($data->avg('clicks'), 2);
    
        // Détection des opportunités : impressions > moyenne, CTR < moyenne, position > médiane
        $opportunities = $data->filter(function ($item) use ($avgImpressions, $avgCTR, $medianPosition) {
            return $item['impressions'] > $avgImpressions
                && $item['ctr'] < $avgCTR
                && $item['position'] > $medianPosition;
        })->sortBy('position')->values();
    
        // Requêtes qui performent déjà (top clics)
        $topQueries = $data->sortByDesc('clicks')->take(20)->values();
    
        // Déduction d’un profil global du site (utile pour logs ou personnalisation)
        $profile = match (true) {
            $totalQueries < 20 && $totalImpressions < 100 => 'new',
            $totalQueries < 100 && $totalImpressions < 1000 => 'growing',
            default => 'mature',
        };
    
        return [
            'profile' => $profile,
            'metrics' => [
                'total_queries' => $totalQueries,
                'total_impressions' => $totalImpressions,
                'avg_clicks' => $avgClicks,
                'avg_ctr' => $avgCTR,
                'avg_impressions' => $avgImpressions,
                'median_position' => $medianPosition,
            ],
            'opportunities' => $opportunities,
            'top_queries' => $topQueries,
            'raw' => $data,
        ];
    }
    
    
}
