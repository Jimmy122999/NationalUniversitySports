<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function sport()
    {

    	return $this->belongsTo(Sport::class);
    }

    public function division()
    {

    	return $this->belongsTo(Division::class);
    }

    public function member(){

    	return $this->hasmany(TeamMember::class);
    }
}
