<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Division;
use Faker\Generator as Faker;

$factory->define(Division::class, function (Faker $faker) {
    return [
    	'name' => $faker->State,
    	'sport_id' => function(){
    		return factory('App\Sport')->create()->id;
    	}
    ];
});
