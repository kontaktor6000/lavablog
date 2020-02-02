<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PublishingHouse;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(PublishingHouse::class, function (Faker $faker) {
    $owners = DB::table('owners')->get('id');
    $cities = DB::table('cities')->get('id');

    return [
        'name' => $faker->company,
        'owner_id' => $owners->random()->id,
        'city_id' => $cities->random()->id,
    ];
});
