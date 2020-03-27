<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamApplicant extends Model
{

	protected $fillable = [
	 	'team_id',
	 	'user_id',
	 	'name',
	 	'approved'

	];

	public function team()
	{

		return $this->belongsTo(Team::class);
	}
    //
}
