<?php

namespace App\Models;

class OrientationLetter extends BaseModel
{
    //protected $fillable = array('date', 'content');
    //protected $visible = array('date', 'content');

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

}
