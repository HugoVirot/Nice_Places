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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 150);
            $table->text('message', 1000);
            $table->boolean('lue')->default(false);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('lieu_id')->nullable();
            $table->foreign('lieu_id')->references('id')->on('lieus')->onDelete('cascade');
        
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
        Schema::dropIfExists('notifications');
    }
};
