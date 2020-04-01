<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $guarded = [
        

    ];
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
    public function post(){

        return $this->hasmany(TeamPost::class);
    }

    public function application(){

        return $this->hasmany(TeamApplicant::class);
    }

    public function pendingApplication(){

        return $this->hasmany(TeamApplicant::class)->where('approved', '=', 0);
    }

    public function fixture(){

        return $this->hasmany(Fixture::class);
    }

}
