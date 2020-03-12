<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventParticipationPackage extends Model
{
    protected $table = 'events_participation_packages';
    protected $fillable = ['event_id', 'package_id', 'gender_id', 'cost', 'number_of_participants'];


    public function packages()
    {
        return $this->hasMany('App\Package', 'id', 'package_id');
    }

    public function genders()
    {
        return $this->hasMany('App\Gender', 'id', 'gender_id');
    }







}
