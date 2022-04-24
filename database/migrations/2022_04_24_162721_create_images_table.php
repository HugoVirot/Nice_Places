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
            $table->string('nom', 30);
            $table->foreignId('user_id')->constrained()->onDelete('set null');
            $table->unsignedBigInteger('lieu_id')->nullable();
            $table->foreign('lieu_id')->references('id')->on('lieu')->onDelete('cascade');
            $table->boolean('profil')->default(false);
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
