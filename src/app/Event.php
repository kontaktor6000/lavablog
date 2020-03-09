<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'event_name',
        'begin_date', 'end_date',
        'begin_time', 'end_time',
        'event_image_preview', 'country_id',
        'basic_cost', 'vip_cost',
        'event_place',
        'event_basic_description', 'event_vip_description',
        'woman_basic_member', 'man_basic_member',
        'woman_vip_member', 'man_vip_member',
        'event_images[]',
        'event_video',
    ];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function photos()
    {
        return $this->hasMany('App\EventPhoto');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student')->withPivot('moderation', 'event_participation_package_id');
    }

    public function eventsstudents()
    {
        return $this->belongsTo('App\EventStudent', 'id', 'event_id');
    }

    public function eventpackages()
    {
        return $this->hasManyThrough('App\Package',
                                    'App\EventStudent',
                                    'event_id',
                                  'id',
                                    'id',
                               'event_participation_package_id');
    }

/*    public function package()
    {
        return $this->hasMany('App\Package', 'id', 'event_participation_package_id');
    }*/

/*    public function students()
    {
        return $this->belongsToMany('App\Student');
    }*/

/*    public function eventsstudents()
    {
        //return $this->belongsToMany('App\EventStudent', 'event_student')->withPivot('event_id', 'student_id');
        return $this->hasOneThrough('App\Student', 'App\EventStudent');
    }*/

}
