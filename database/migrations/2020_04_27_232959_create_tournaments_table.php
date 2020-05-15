<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            /*$table->foreignId('lan_id')->constrained('lan');
            $table->foreignId('jeu_id')->constrained('jeu');*/
        });


        Schema::table('tournaments', function($table) {
          $table->unsignedBigInteger('lan_id');
          $table->foreign('lan_id')->references('id')->on('lan');
        });

        /*Schema::table('tournaments', function($table) {
          $table->unsignedBigInteger('game_id');
          $table->foreign('game_id')->references('id')->on('game');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
