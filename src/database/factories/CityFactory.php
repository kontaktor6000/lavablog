<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'country_id' => $faker->numberBetween(1, 10),
        'name' => $faker->unique()->city,
    ];
});


