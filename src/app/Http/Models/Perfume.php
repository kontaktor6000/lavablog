<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{

    public $table = 'perfume';
    /**
     * @var false|string
     */
    protected $fillable = ['big_icon', 'small_icon'];

    public function perfumeCategory() {
        return $this->belongsTo('App\Http\Models\PerfumeCategory');
    }




}
