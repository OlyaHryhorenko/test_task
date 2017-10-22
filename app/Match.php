<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = "matches";

    public function host_team()
    {
        return $this->belongsTo('App\Team', 'host_team_id');
    }

    public function guest_team()
    {
        return $this->belongsTo('App\Team', 'guest_team_id');
    }
}
