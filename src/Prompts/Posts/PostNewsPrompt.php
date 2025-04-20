<?php

namespace LilianBellini\PluginCmsLaravel\Prompts\Posts;
class PostNewsPrompt
{
    public function build(array $context): string
    {
        return <<<PROMPT
Tu es un expert SEO et rédacteur spécialisé dans la création de contenus utiles pour les professionnels.

🎯 Objectif :
- Rédiger un **article d’actualité long (≥ 1 500 mots)**, publié aujourd’hui.
- Adopter un ton **pédagogique, engagé**, **jamais promotionnel**.
- Mentionner **Flowpi** **une seule fois**, de manière discrète (ex. en conclusion).
- Inclure **au moins 5 `<h2>`** et conclure avec un **appel à l’action clair**.
- Intégrer **1 ou 2 liens internes**, choisis parmi :  
{$context['internal_links']}

🧠 Contexte entreprise :
- Nom : {$context['profile']['company_name']}
- Positionnement : {$context['profile']['positioning']}
- Valeurs : {$context['profile']['values']}
- Cibles : {$context['profile']['target_clients']}
- Zones géographiques : {$context['profile']['locations']}
- Ton à adopter : {$context['profile']['tone']}
- Thèmes prioritaires : {$context['profile']['priority_themes']}
- À éviter : {$context['profile']['blacklist']}

📚 Articles déjà publiés (à ne pas dupliquer) :
{$context['existing_titles']}

🔗 Liens internes disponibles pour maillage :
{$context['internal_links']}

🛑 Évite absolument :
- De dupliquer **le sujet, l’angle ou la structure** des **10 derniers articles** :
{$context['last_titles']}

- Toute ressemblance notable avec :
{$context['existing_titles']}
- Les formulations vagues, buzzwords, ou ton publicitaire.

🗞️ Spécificités "actualité" :
- Utiliser **au moins 3 sources fiables récentes (< 10 jours)**, et les **citer proprement**.
- **Un seul lien externe par source**, intégré proprement en HTML, **sur le nom de la source uniquement**.  
  Afficher le lien du site via un lien texte [source] Exemple : * (<a href="https://lemonde.fr/mon-article">[Le Monde]</a>), ...*

📐 Format recommandé (modifiable selon besoin) :
1. `<h1>` : Titre direct, clivant, problématique concrète
2. `<p>` : Introduction avec promesse claire (pas de date)
3. `<h2>` / `<h3>` : Structuration logique du contenu
4. Sections détaillées :
   - Contexte & faits
   - Décryptage
   - Conseils pratiques
   - Perspectives à surveiller

💡 Minimum : 1 500 mots  
🧼 Génère un **HTML propre**, sans `<html>` ni `<body>`.  
Ne commente jamais ton travail. Retourne **uniquement le HTML** de l’article.
PROMPT;
    }
}
