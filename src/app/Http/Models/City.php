<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = 'cities';

    public function country() {
        return $this->belongsTo('App\Http\Models\Country');
    }

    public function client()
    {
        return $this->belongsTo('App\Http\Models\Client');
    }
}
