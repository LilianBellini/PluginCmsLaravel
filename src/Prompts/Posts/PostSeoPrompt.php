<?php

namespace LilianBellini\PluginCmsLaravel\Prompts\Posts;
class PostSeoPrompt
{
    public function build(array $context): string
    {
        return <<<PROMPT
Tu es un expert SEO et rédacteur spécialisé dans la création de contenus utiles pour les professionnels.

🎯 Objectif :
- Créer un article réellement **utile pour le lecteur**, en lui apportant des **conseils concrets**, des **bonnes pratiques**, ou des **résolutions de problèmes métiers**.
- Le ton doit être **pédagogique**, **engagé**, mais **jamais centré sur la promotion de l’entreprise**.
- L’article doit répondre à une intention de recherche claire, apporter une vraie **valeur pratique**, et **pouvoir vivre de manière autonome**, sans dépendre de Flowpi.
- Tu peux parler de Flowpi **uniquement si c’est pertinent et discret**, comme un outil possible parmi d’autres.
- Le but est de construire une **bibliothèque d’articles de fond**, variés, utiles, inspirants ou méthodologiques.

📊 Données globales :
- Total requêtes : {$context['metrics']['total_queries']}
- Total impressions : {$context['metrics']['total_impressions']}
- CTR moyen : {$context['metrics']['avg_ctr']}%
- Position médiane : {$context['metrics']['median_position']}

🔎 Requêtes à fort potentiel :
{$context['formatted_opportunities']}

🔥 Top requêtes par clics :
{$context['formatted_top_queries']}

📖 Autres requêtes brutes :
{$context['formatted_raw_queries']}

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

🔗 Articles internes disponibles pour maillage :
{$context['internal_links']}

⚠️ Contraintes importantes :
- **Ne duplique pas la structure, le ton ou les angles** des 5 derniers articles :
{$context['last_titles']}
- Évite les formulations vagues ou publicitaires.
- Varie les formats : tuto, guide pas à pas, checklists, erreurs à éviter, étude de cas (fictive ou non), exemples concrets, comparatif, mini FAQ, storytelling métier...
- Concentre-toi sur **les problèmes concrets de tes lecteurs** (PME, indépendants, dirigeants, métiers opérationnels, etc).

🧱 Format suggéré (à adapter librement selon le sujet choisi) :
1. `<h1>` : Titre clair et optimisé
2. `<p>` : Introduction directe et engageante
3. `<h2>` / `<h3>` : Structuration logique
4. `<p>` : Contenu dense mais lisible
5. 2+ liens internes (choisis les plus pertinents)
6. Conclusion avec un **appel à l’action orienté aide** ("Besoin d'aide sur ce sujet ? Contactez-nous", ou autre)
7. Minimum de mot minimum 800 mots. 

Ne commente jamais ton travail. Ne parle jamais de ton intention. Retourne uniquement le contenu HTML de l’article, sans aucune explication.

PROMPT;
    }
}
