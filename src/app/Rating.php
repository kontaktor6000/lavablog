<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $table = 'ratings';

    public $guarded = [];

    public function reader()
    {
        return $this->belongsTo('App\Reader');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
