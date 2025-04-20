
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleApiCredentialsTable extends Migration
{
    public function up()
    {
        Schema::create('google_api_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->string('client_secret');
            $table->json('token')->nullable(); // access + refresh token
            $table->string('email')->nullable(); // pour savoir à qui il appartient
            $table->string('site_url');
            $table->string('site_post_url')->nullable(); // pour savoir à qui il appartient
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('google_api_credentials');
    }
}