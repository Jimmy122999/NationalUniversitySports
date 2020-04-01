<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $guarded = [
        

    ];

    public function homeTeam()
    {

    	return $this->belongsTo(Team::class , 'home_team_id' , 'id');
    }
    public function awayTeam()
    {

    	return $this->belongsTo(Team::class , 'away_team_id' , 'id');
    }
}
