<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    public $timestamps = false;

    protected $table = 'absents';

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

}
