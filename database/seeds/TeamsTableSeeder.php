<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = new Team();
        $team->name = 'Team 1';
        $team->save();

        $team = new Team();
        $team->name = 'Team 2';
        $team->save();

        $team = new Team();
        $team->name = 'Team 3';
        $team->save();

        $team = new Team();
        $team->name = 'Team 4';
        $team->save();

        $team = new Team();
        $team->name = 'Team 5';
        $team->save();
    }
}
