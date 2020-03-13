<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $fillable = ['name'];

/*    public function event()
    {
        return $this->belongsTo('App\EventStudent', 'id', 'event_participation_package_id');
    }*/
    public function events()
    {
        return $this->belongsToMany('App\Event','App\EventParticipationPackage',
                                    'package_id', 'event_id');
    }


    public function genders()
    {
        return $this->belongsToMany('App\Gender',
                                      'App\EventParticipationPackage',
                              'package_id',
                              'gender_id');
    }

    public function eventsParticipationPackages()
    {
        return $this->hasMany('App\EventParticipationPackage', 'package_id', 'id');
    }
}
