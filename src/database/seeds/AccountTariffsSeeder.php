<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTariffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountTariffs = [
            'Premium' => 365,
            'Basic' => 30,
            'Trial' => 21,
            'Nishebrod' => 10,
        ];

        foreach($accountTariffs as $accountTariff => $freeTerm){
            DB::table('account_tariffs')->insert([
                'name' => $accountTariff,
                'free_term'     => $freeTerm,
            ]);
        }
    }
}
