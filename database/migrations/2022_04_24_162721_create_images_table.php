<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('lieu_id')->nullable(); // pas de lieu_id => image de profil ou image de catégorie
            $table->foreign('lieu_id')->references('id')->on('lieus')->onDelete('cascade');
            $table->boolean('mise_en_avant')->default(false); // pour le lieu => couverture / pour le user => image de profil
            $table->integer('longueur')->nullable();
            $table->integer('largeur')->nullable();
            $table->integer('taille')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
