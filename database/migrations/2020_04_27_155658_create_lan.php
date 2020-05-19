<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lans', function (Blueprint $table) {
            $table->id();
            /*$table->foreignId('user_id')->constrained();*/
            $table->string('nom');
            $table->integer('max');
            $table->dateTime('date');
            $table->text('info');
            $table->timestamps();
        });

        Schema::table('lans', function($table) {
          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lan');
    }
}
