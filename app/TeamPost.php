<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamPost extends Model
{

	protected $guarded = [
	    

	];
    public function team()
    {

    	return $this->belongsTo(Team::class);
    }

    public function teamMember()
    {

    	return $this->belongsTo(TeamMember::class);
    }



}
