<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PerfumeCategory extends Model
{
    public $table = 'perfume_categories';

    public function perfumes()
    {
        return $this->hasMany('App\Http\Models\Perfume');
    }

}
