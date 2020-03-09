<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peach extends Model
{
    protected $table = 'peachs';
    protected $fillable = ['informer_id', 'violator_id', 'shot_peach', 'full_peach'];

    public function students()
    {
        return $this->belongsTo('App\Student', 'informer_id', 'id');
    }
}
