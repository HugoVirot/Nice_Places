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
        Schema::create('lieus', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('description', 3000);
            $table->decimal('latitude', 10, 7);  // 1er chiffre = nombre total de chiffres, 2ème = longueur partie décimale
            $table->decimal('longitude', 10, 7);  // idem
            $table->float('note', 3, 1);  // idem
            $table->integer('temps'); // temps en heures
            $table->enum('difficulte', ['famille', 'amateur', 'sportif']);
            $table->integer('kilometres')->nullable();
            $table->string('adresse', 75);
            $table->char('code_postal', 5);
            $table->string('ville', 50);
            $table->enum('statut', ['validé', 'en attente', 'à modifier', 'refusé']);
            $table->text('commentaire', 1000)->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->foreignId('categorie_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lieus');
    }
};
