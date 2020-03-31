<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfilePost extends Model
{

	protected $guarded = [
	    

	];
	
    public function member()
    {

    	return $this->belongsTo(UserProfile::class);
    }
}
