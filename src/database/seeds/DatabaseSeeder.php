<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        //$this->call(AuthorsTableSeeder::class);
        //$this->call(OwnersTableSeeder::class);
        //$this->call(ReadersTableSeeder::class);
        //$this->call(PublishingHousesTableSeeder::class);
    }
}
