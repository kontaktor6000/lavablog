<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventStudent extends Model
{
    protected $table = 'event_student';

    protected $fillable = ['event_id', 'student_id'];

    public function packages()
    {
        return $this->hasMany('App\Package', 'id', 'event_participation_package_id');
    }

    public function student()
    {
        return $this->hasOne('App\Student', 'id', 'student_id');
    }

    public function eventParticipationPackage()
    {
        return $this->hasOne('App\EventParticipationPackage',
                            'id',
                            'event_participation_package_id');
    }




}
