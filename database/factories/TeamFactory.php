<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord,
        'division_id' => function(){
        	return factory('App\Division')->create()->id;
        },
        'played' => 0,
        'wins' => 0,
        'draws' => 0,
        'losses' => 0,
        'points' => 0,
    ];
});
