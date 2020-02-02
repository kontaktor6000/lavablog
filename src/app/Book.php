<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $table = 'books';

    public $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }

    public function publishing()
    {
        return $this->belongsTo('App\PublishingHouse', 'publishing_house_id', 'id');
    }

    public function rating()
    {
        return $this->hasMany('App\Rating', 'book_id', 'id');
    }
}
