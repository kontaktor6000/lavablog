<?php

use Illuminate\Database\Seeder;

class PublishingHousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PublishingHouse::class, 20)->create()->each(function ($publishingHouse) {
            $publishingHouse->owners()->save(factory(App\PublishingHouse::class)->make());
            $publishingHouse->cities()->save(factory(App\City::class)->make());
        });
    }
}
