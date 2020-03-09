<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    protected $table = 'referral_codes';

    protected $fillable = ['referral_codes', 'account_tariff_id'];

    public function accounttariff()
    {
        return $this->belongsTo('App\AccountTariff');
    }

    public function trialperiodgroup()
    {
        return $this->hasOne('App\TrialPeriodGroup', 'id', 'trial_period_group_id');
    }
}
