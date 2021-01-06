<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Prescription extends BaseModel
{

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
