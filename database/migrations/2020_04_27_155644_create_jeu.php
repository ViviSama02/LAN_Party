<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeu', function (Blueprint $table) {
            $table->id();
            $table->string('titre_jeu');
            $table->foreignId('intitule_genre')->constrained('genre');
            /* piste
            $table->string('intitule_genre')->unsigned;
            $table->foreign('intitule_genre')->references('intitule_genre')->on('genre');*/
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
        Schema::dropIfExists('jeu');
    }
}
