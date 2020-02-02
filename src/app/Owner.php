<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public $table = 'owners';

    public $guarded = [];

    public function publishing()
    {
        return $this->hasMany(PublishingHouse::class, 'owner_id', 'id');
    }
}
