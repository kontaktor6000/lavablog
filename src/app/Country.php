<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';

    public $guarded = [];

    public function city()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
