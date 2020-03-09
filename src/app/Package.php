<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $fillable = ['name'];

    public function event()
    {
        return $this->belongsTo('App\EventStudent', 'id', 'event_participation_package_id');
    }
}
