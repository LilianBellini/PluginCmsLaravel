<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seo_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->text('positioning');
            $table->json('values')->nullable();
            $table->json('target_clients')->nullable();
            $table->json('locations')->nullable();
            $table->text('tone');
            $table->json('priority_themes')->nullable();
            $table->json('blacklist')->nullable();
            $table->text('image_style_prompt')->nullable();
            $table->boolean('auto_publish_enabled');
            $table->string('generation_frequency')->nullable();
            $table->boolean('auto_publish_generated_article');
            $table->unsignedTinyInteger('article_mix_ratio'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_profiles');
    }
};
