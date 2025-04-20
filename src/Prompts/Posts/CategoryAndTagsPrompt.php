<?php

namespace LilianBellini\PluginCmsLaravel\Prompts\Posts;

class CategoryAndTagsPrompt
{
    public static function systemMessage(string $categoriesList, string $tagsList): string
    {
        return <<<SYS
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
SYS;
    }
}
