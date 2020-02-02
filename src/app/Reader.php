<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    public $table = 'readers';

    public $guarded = [];

    public function rating()
    {
        return $this->hasMany('App\Rating', 'reader_id', 'id');
    }
}
