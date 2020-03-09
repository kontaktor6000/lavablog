<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    protected $table = 'events_photos';

    protected $fillable = [
        'photo',
        'event_id',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
