<?php

use App\ReferralCode;
use Illuminate\Database\Seeder;

class ReferralCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ReferralCode::class, 10)->create();
    }
}
