<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Appointment extends BaseModel
{

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

}
