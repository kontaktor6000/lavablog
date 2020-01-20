<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public $table = 'owners';

    public $guarded = [];

    public function publishingHouses()
    {
        return $this->hasMany(PublishingHouse::class);
    }
}
