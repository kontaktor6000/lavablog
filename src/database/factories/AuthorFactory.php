<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'second_name' => $faker->lastName,
    ];
});
