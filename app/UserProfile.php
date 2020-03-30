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
    

    // public function getRouteKeyName()
    // {

    //     return user()->name;


    // }
}
