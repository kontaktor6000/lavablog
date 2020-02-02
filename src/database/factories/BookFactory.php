<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Book::class, function (Faker $faker) {
    $authors = DB::table('authors')->get('id');
    $publishing_houses = DB::table('publishing_houses')->get('id');

    return [
        'name' => $faker->unique()->sentence(rand(1, 4), true),
        'years' => $faker->year($max='now'),
        'author_id' => $authors->random()->id,
        'publishing_house_id' => $publishing_houses->random()->id,
    ];
});
