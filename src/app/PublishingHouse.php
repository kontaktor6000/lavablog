<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublishingHouse extends Model
{
    public $table = 'publishing_houses';

    public $guarded = [];

    public function cities()
    {
        return $this->belongsTo(City::class);
    }

    public function owners()
    {
        return $this->belongsTo(Owner::class);
    }
}
