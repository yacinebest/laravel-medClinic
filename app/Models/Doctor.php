<?php

namespace App\Models;

use App\Models\Base\AuthEntity;

class Doctor extends AuthEntity
{
    public function orientationLetters()
    {
        return $this->hasMany('App\Models\OrientationLetter');
    }

    public function prescriptions()
    {
        return $this->hasMany('App\Models\Prescription');
    }

    public function appointments()
    {
        return $this->morphMany('App\Models\Appointment','appointmentable');
    }


}
