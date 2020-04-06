<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{

	protected $guarded = [
		
	];
    public function team()
    {

    	return $this->belongsTo(Team::class);
    }

    public function post()
    {

    	return $this->hasMany(TeamPost::class);
    }

    public function profile()
    {

        return $this->hasOne(UserProfile::class);
    }

    public function user(){

        return $this->hasOne(User::class , 'id' , 'user_id');
    }
}
