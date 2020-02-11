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

/*    public function books()
    {
        return $this->hasManyThrough(Book::class,
                                    PublishingHouse::class,
                                    'owner_id',
                                    'publishing_house_id',
                                    'id',
                                    'id'
        );
    }*/
}
