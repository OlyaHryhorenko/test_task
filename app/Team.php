<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function winner()
    {
        return $this->belongsToMany('Team', 'losers_winners', 'team_id', 'winner_id' )
            ->withTimestamps();
    }

    public function looser()
    {
        return $this->belongsToMany('Team', 'losers_winners', 'loser_id', 'team_id' )
            ->withTimestamps();
    }

    public function standing()
    {
        $this->hasOne('App\Standing');
    }
}
