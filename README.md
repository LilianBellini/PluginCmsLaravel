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

dans le modele app/Models/User.php : 

use Lilian\PluginCmsLaravel\Traits\UserTrait; // Importation du trait

class User extends Authenticatable
{
    use UserTrait; // Inclusion du trait

    // Le reste de ton modèle User
}