<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class OrientationLetter extends BaseModel
{
    public $fillable=['date','content','patient_id','doctor_id'];
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

}
