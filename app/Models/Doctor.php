<?php

namespace App\Models;

use App\Models\Base\AuthEntity;

class Doctor extends AuthEntity
{
    public $fillable=['last_name','first_name','username','email','specialty','password'];
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
        return $this->hasMany('App\Models\Appointment');
    }


}
