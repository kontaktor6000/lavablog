<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublishingHouse extends Model
{
    public $table = 'publishing_houses';

    public $guarded = [];

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Owner', 'owner_id', 'id');
    }

    public function book()
    {
        return $this->hasMany('App\Book', 'publishing_house_id', 'id');
    }
}
