<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamPost extends Model
{
    public function team()
    {

    	return $this->belongsTo(Team::class);
    }
}
