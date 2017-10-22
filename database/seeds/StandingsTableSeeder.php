<?php

use Illuminate\Database\Seeder;
use App\Standing;

class StandingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $standing = new Standing();
        $standing->team_id = '1';
        $standing->save();

        $standing = new Standing();
        $standing->team_id = '2';
        $standing->save();

        $standing = new Standing();
        $standing->team_id = '3';
        $standing->save();

        $standing = new Standing();
        $standing->team_id = '4';
        $standing->save();

        $standing = new Standing();
        $standing->team_id = '5';
        $standing->save();
    }
}
