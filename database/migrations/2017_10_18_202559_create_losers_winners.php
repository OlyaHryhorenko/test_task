<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLosersWinners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('losers_winners', function (Blueprint $table) {
            $table->integer('loser_id')->unsigned()->index();
            $table->foreign('loser_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('winner_id')->unsigned()->index();
            $table->foreign('winner_id')->references('id')->on('teams')->onDelete('cascade');
            $table->dateTime("game_time");
            $table->integer("loser_score")->default(0);
            $table->integer("winner_score")->default(0);
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
