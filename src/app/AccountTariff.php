<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountTariff extends Model
{
    protected $table = 'account_tariffs';

    protected $fillable = ['name', 'free_term'];

    public function referralCodes()
    {
        return $this->hasMany('App\ReferralCode');
    }

/*    public function students()
    {
        return $this->hasMany('App\Student', 'account_tariff_id', 'id');
    }*/

}
