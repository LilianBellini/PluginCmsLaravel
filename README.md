# Plugin CMS Laravel

## License

This project is licensed under the MIT License. See the [LICENSE](./LICENSE) file for details.

---

## Requirements

- Laravel project
- Laravel Breeze for authentication

---

## Installation Steps

1. Add the package to your project:
   composer require systemin/plugincmslaravel

2. Run the database migrations:
   php artisan migrate

3. Seed the initial data for the CMS:
   php artisan plugin-cms:seed

4. Install Bootstrap Icons:
   npm i bootstrap-icons

5. Create a public directory for CMS assets:
   mkdir public/assets

6. Copy the CMS assets to the public directory:
   cp -r vendor/systemin/plugincmslaravel/assets/cms public/assets

---

## Configuration Steps

### User Model

In your `app/Models/User.php`, add the `UserTrait`:

use LilianBellini\PluginCmsLaravel\Traits\UserTrait; // Import the trait

class User extends Authenticatable
{
    use UserTrait; // Include the trait

    // Add the following attributes to the fillable array:
    protected $fillable = [
        'role_id',
        'avatar',
        'bio',
        // Other attributes
    ];
}

---

### App Configuration

In the `config/app.php` file, add the following:

'langages' => ['fr', 'en'],

---

### CSS Setup

In your `resources/css/app.css` file, import the CMS styles:

@import '../../vendor/systemin/plugincmslaravel/resources/css/main.css';

---

Follow these steps to fully integrate the CMS into your Laravel project.
