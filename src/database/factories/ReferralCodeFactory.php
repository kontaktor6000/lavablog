<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ReferralCode;
use Faker\Generator as Faker;

$factory->define(ReferralCode::class, function (Faker $faker) {
    return [
        'referral_code' => $faker->lexify('??????'),
    ];
});
