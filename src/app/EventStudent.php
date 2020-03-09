<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventStudent extends Model
{
    protected $table = 'event_student';
    //protected $primaryKey = ['event_id', 'student_id'];
    //public $incrementing=false;

    protected $fillable = ['event_id', 'student_id'];

    public function packages()
    {
        return $this->hasMany('App\Package', 'id', 'event_participation_package_id');
    }




}
