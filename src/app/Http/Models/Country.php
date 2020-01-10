<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';

    public function cities()
    {
        return $this->hasMany('App\Http\Models\City');
    }


}
