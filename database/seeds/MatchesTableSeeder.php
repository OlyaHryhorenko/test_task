<?php

use Illuminate\Database\Seeder;
use App\Match;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $match = new Match();
        $match->host_team_id = 1;
        $match->guest_team_id = 2;
        $match->host_team_result = 0;
        $match->guest_team_result = 2;
        $match->match_date = '2017-10-10 18:00:00';
        $match->save();


        $match = new Match();
        $match->host_team_id = 2;
        $match->guest_team_id = 3;
        $match->host_team_result = 2;
        $match->guest_team_result = 2;
        $match->match_date = '2017-10-12 18:00:00';
        $match->save();

        $match = new Match();
        $match->host_team_id = 3;
        $match->guest_team_id = 4;
        $match->host_team_result = 3;
        $match->guest_team_result = 1;
        $match->match_date = '2017-10-16 18:00:00';
        $match->save();

        $match = new Match();
        $match->host_team_id = 4;
        $match->guest_team_id = 5;
        $match->host_team_result = 1;
        $match->guest_team_result = 1;
        $match->match_date = '2017-10-16 18:00:00';
        $match->save();
    }
}
