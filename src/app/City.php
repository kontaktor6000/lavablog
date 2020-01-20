<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = 'cities';

    public $guarded = [];

    public function countries()
    {
        return $this->belongsTo(Country::class);
    }

    public function publishingHouses()
    {
        return $this->hasMany(PublishingHouse::class);
    }
}
