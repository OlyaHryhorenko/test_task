<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    public function team()
    {
        $this->belongsTo('App\Team');
    }
}
