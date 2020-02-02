<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\App\City::class, function (Faker $faker) {
    $countries = DB::table('countries')->get('id');

    return [
        'name' => $faker->unique()->city,
        'country_id' => $countries->random()->id,
    ];
});
