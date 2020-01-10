<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'clients';
    protected $guarded = [];

    public function city()
    {
        return $this->hasOne('App\Modesl\City');
    }

}
