<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixtureResult extends Model
{
    protected $guarded = [
        

    ];

    public function fixture()
    {

    	return $this->hasOne(Fixture::class);
    }
}
