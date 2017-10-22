<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    public function matches()
    {
        return $this->hasMany('App\Match', 'id');
    }

    public function standing()
    {
        return $this->hasOne('App\Standing');
    }
}
