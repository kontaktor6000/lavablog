<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    //public $timestamps = false;

    protected $table = 'students';

    public function referralcode()
    {
        return $this->belongsTo('App\ReferralCode', 'referral_code_id', 'id');
    }

    public function accounttariff()
    {
        return $this->belongsTo('App\AccountTariff', 'account_tariff_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'who_liked_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    public function eventsstudents()
    {
        return $this->hasMany('App\EventStudent');
    }

    public function eventspackages()
    {
        return $this->hasManyThrough('App\Package',
                                    'App\EventStudent',
                                    'student_id',
                                    'id',
                                    'id',
                                    'event_participation_package_id');
    }


/*    public function age()
    {
        return $this->birthday->diffInYears(Carbon::now());
    }*/

    public function peachs()
    {
        return $this->hasMany('App\Peach');
    }

    public function sexualaffilation()
    {
        return $this->hasOne('App\SexualAffilation');
    }

/*    public function eventsstudents()
    {
        return $this->belongsToMany('App\EventStudent', 'event_student', 'event_id');
    }*/










}
