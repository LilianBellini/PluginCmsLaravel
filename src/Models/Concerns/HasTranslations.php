<?php
// src/Models/Concerns/HasTranslations.php
namespace LilianBellini\PluginCmsLaravel\Models\Concerns;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTranslations
{
    public function translations(): HasMany
    {
        return $this->hasMany($this->translationModel());
    }

    public function getTranslation(string $locale = null)
    {
        $locale ??= app()->getLocale();
        return $this->translations->firstWhere('locale', $locale);
    }

    abstract protected function translationModel(): string;
}
