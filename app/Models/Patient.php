<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Patient extends BaseModel
{

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function orientationLetters()
    {
        return $this->hasMany('App\Models\OrientationLetter');
    }

    public function prescriptions()
    {
        return $this->hasMany('App\Models\Prescription');
    }

    public function imageries()
    {
        return $this->hasMany('App\Models\Imagery');
    }

}
