<?php

use Illuminate\Database\Seeder;

class StandingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = new Team();
        $team->team_id = '1';
        $team->save();

        $team = new Team();
        $team->team_id = '2';
        $team->save();

        $team = new Team();
        $team->team_id = '3';
        $team->save();

        $team = new Team();
        $team->team_id = '4';
        $team->save();

        $team = new Team();
        $team->team_id = '5';
        $team->save();
    }
}
