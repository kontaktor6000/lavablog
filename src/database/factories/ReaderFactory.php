<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reader;
use Faker\Generator as Faker;

$factory->define(\App\Reader::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});
