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
        Schema::create('lieux', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->decimal('latitude', 9, 6);  // 1er chiffre = nombre total de chiffres, 2ème = longueur partie décimale
            $table->decimal('longitude', 9, 6);  // idem
            $table->float('note', 2, 1);  // idem
            $table->integer('temps'); // temps en heures
            $table->enum('difficulte', ['famille', 'amateur', 'sportif'])->nullable();
            $table->string('adresse', 75);
            $table->char('code_postal', 5);
            $table->string('ville', 50);
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
        Schema::dropIfExists('lieux');
    }
};
