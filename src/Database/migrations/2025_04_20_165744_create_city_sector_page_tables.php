<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        /* Tables principales --------------------------------- */
        Schema::create('cities', fn (Blueprint $t) => $this->item($t));
        Schema::create('sectors', fn (Blueprint $t) => $this->item($t));

        Schema::create('pages', function (Blueprint $t) {
            $t->id();
            $t->foreignId('city_id')->constrained()->cascadeOnDelete();
            $t->foreignId('sector_id')->constrained()->cascadeOnDelete();
            $t->string('template')->default('default');
            $t->timestamps();
        });

        /* Tables de traduction -------------------------------- */
        $this->translation('city',   'cities');
        $this->translation('sector', 'sectors');

        // 👉 traduction spécifique pour les pages (data JSON par langue)
        Schema::create('page_translations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $t->string('locale', 2);
            $t->json('data')->nullable();
            $t->unique(['page_id', 'locale']);
        });
    }

    /* Helpers ------------------------------------------------ */
    private function item(Blueprint $t): void
    {
        $t->id();
        $t->timestamps(); // 🧹 pas de user_id ici
    }

    private function translation(string $singular, string $parent): void
    {
        Schema::create("{$singular}_translations", function (Blueprint $t) use ($singular, $parent) {
            $t->id();
            $t->foreignId("{$singular}_id")->constrained($parent)->cascadeOnDelete();
            $t->string('locale', 2);
            $t->string('name');
            $t->string('slug');
            $t->unique(["{$singular}_id", 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('sector_translations');
        Schema::dropIfExists('city_translations');

        Schema::dropIfExists('pages');
        Schema::dropIfExists('sectors');
        Schema::dropIfExists('cities');
    }
};
