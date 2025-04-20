<?php

namespace LilianBellini\PluginCmsLaravel\Controllers\Admin;

use LilianBellini\PluginCmsLaravel\Enums\ArticleType;
use LilianBellini\PluginCmsLaravel\Services\Generate\GeneratePostService;
use Illuminate\Http\RedirectResponse;
use LilianBellini\PluginCmsLaravel\Controllers\Controller;

class ArticleGenerationController extends Controller
{
    public function __construct(private GeneratePostService $generator)
    {
        // $this->middleware('auth'); // si vous le souhaitez
    }

    /**
     * Lance la génération d’un article SEO classique.
     */
    public function generateSeo(): RedirectResponse
    {
        $this->generator->generateArticle(ArticleType::SEO);

        return back()->with('success', 'Article SEO généré avec succès !');
    }

    /**
     * Lance la génération d’un article d’actualité / News.
     */
    public function generateNews(): RedirectResponse
    {
        $this->generator->generateArticle(ArticleType::NEWS);

        return back()->with('success', 'Article d’actualité généré avec succès !');
    }
}
