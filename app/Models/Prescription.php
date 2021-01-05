<?php

namespace App\Models;

class Prescription extends BaseModel
{
    //protected $fillable = array('date');
    //protected $visible = array('date');

    public function prescriptionLines()
    {
        return $this->hasMany('App\Models\PrescriptionLine');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

}
