<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('host_team_id')->unsigned();
            $table->foreign('host_team_id')->references('id')->on('teams');
            $table->integer('guest_team_id')->unsigned();
            $table->foreign('guest_team_id')->references('id')->on('teams');
            $table->integer('host_team_result')->nullable();
            $table->integer('guest_team_result')->nullable();
            $table->dateTime('match_date');
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
        //
    }
}
