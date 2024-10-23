Require projet laravel / breeze 
Ajouter dans le composer.json 

    "repositories": [
        {
            "type": "vcs",
            "url": "git@79.86.252.210:Lilian/plugincmslaravel.git"
        }
    ],

Lancer la commande : 
composer require lilian/plugincmslaravel
php artisan migrate
php artisan plugin-cms:seed
npm i bootstrap-icons

cp -r vendor/lilian/plugincmslaravel/assets/cms public/assets

dans le modele app/Models/User.php : 

use Lilian\PluginCmsLaravel\Traits\UserTrait; // Importation du trait

class User extends Authenticatable
{
    use UserTrait; // Inclusion du trait

    et dans le fillable: 
        'role_id',
        'avatar',
        'news_letter',
        'bio',
        'url_fb',
        'url_insta',
        'url_twitter',
        'url_linkedin'

    // Le reste de ton modèle User
}

dans config/app.php, ajouter

    'langages' => ['fr', 'en'],