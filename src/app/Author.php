<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $table = 'authors';

    public $guarded = [];

    public function book()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
}
