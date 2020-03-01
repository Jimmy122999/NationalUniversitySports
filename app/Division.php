<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function sport()
    {

    	return $this->belongsTo(Sport::class);
    }
}
