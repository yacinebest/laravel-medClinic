<?php

namespace App\Models;

class Imagery extends BaseModel
{
    //protected $fillable = array('file');
    //protected $visible = array('file');

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

}
