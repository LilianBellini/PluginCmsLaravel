<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->default(3)->constrained('roles')->onDelete('cascade');
            $table->string('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('url_fb')->nullable();
            $table->string('url_insta')->nullable();
            $table->string('url_twitter')->nullable();
            $table->string('url_linkedin')->nullable();
            $table->boolean('news_letter')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id',
                'bio',
                'avatar',
                'url_fb',
                'url_insta',
                'url_twitter',
                'url_linkedin',
                'news_letter'
            ]);
        });
    }
};
