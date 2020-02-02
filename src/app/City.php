<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = 'cities';

    public $guarded = [];

    public function publishingHouse()
    {
        return $this->hasMany('App\PublishingHouse', 'city_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }



}
