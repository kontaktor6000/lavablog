<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\App\Rating::class, function (Faker $faker) {

    $books = DB::table('books')->get('id');
    $readers = DB::table('readers')->get('id');

    return [
        'book_id' => $books->random()->id,
        'reader_id' => $readers->random()->id,
        'assessment' => $faker->numberBetween(1, 10),
    ];
});
