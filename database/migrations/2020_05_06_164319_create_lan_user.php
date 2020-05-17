<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lan_user', function (Blueprint $table) {
            $table->id();
        });

        Schema::table('lan_user', function($table) {
          $table->unsignedBigInteger('lan_id');
          $table->foreign('lan_id')->references('id')->on('lan');
        });

        Schema::table('lan_user', function($table) {
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
        Schema::dropIfExists('lan_user');
    }
}
