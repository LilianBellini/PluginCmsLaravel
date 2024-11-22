<?php

namespace Systemin\PluginCmsLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Systemin\PluginCmsLaravel\Models\Setting;

class SettingFactory extends Factory
{
    /**
     * Le modèle correspondant à cette factory.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Définissez l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'site_name' => $this->faker->word(),
            'contact_email' => $this->faker->email(),
            'description' => $this->faker->sentence(),
            'about' => $this->faker->paragraph(1),
            'copy_rights' => $this->faker->sentence(),
            'url_fb' => $this->faker->url(),
            'url_twitter' => $this->faker->url(),
            'url_insta' => $this->faker->url(),
            'url_linkedin' => $this->faker->url(),
        ];
    }
}
