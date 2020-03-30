<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

	
	protected $guarded = [
	    

	];

    public function user()
    {

    	return $this->hasOne(User::class);
    }
    
    public function member()
    {

        return $this->hasOne(TeamMember::class , 'id' , 'team_member_id');
    }

   
}
