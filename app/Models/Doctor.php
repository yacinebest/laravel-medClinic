<?php

namespace App\Models;

class Doctor extends BaseModel
{
    //protected $guarded = array('username', 'password', 'email');
    //protected $fillable = array('first_name', 'last_name', 'is_admin', 'specialty');
    //protected $visible = array('first_name', 'last_name', 'username', 'email', 'is_admin', 'specialty');
    //protected $hidden = array('password');

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
