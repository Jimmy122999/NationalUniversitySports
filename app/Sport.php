<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

	protected $fillable = [
		'name'

	];

	

    public function division()
    {

    	return $this->hasMany(Division::class);
    }

    public function addDivision($name)
    {
    	Division::create([
    		'sport_id' => ($this->id),
    		'name' => request('name')

    	]);
    }
}

