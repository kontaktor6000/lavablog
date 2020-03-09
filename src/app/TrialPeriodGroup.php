<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrialPeriodGroup extends Model
{
    protected $table = 'trial_period_groups';

    protected $fillable = ['name', 'trial_period'];
}
