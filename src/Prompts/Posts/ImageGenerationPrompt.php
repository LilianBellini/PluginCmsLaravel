<?php

namespace LilianBellini\PluginCmsLaravel\Prompts\Posts;
class ImageGenerationPrompt
{
    public static function forTitle(string $title, string $stylePrompt): string
    {
        return "Illustration professionnelle pour un article intitulé : \"$title\". $stylePrompt";
    }
}
