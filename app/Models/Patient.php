<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Patient extends BaseModel
{
    public $fillable=['last_name','first_name','social_security_number','birth_date','phone_number','address', 'email', 'chronic_diseases', 'allergies', 'antecedents', 'comments'];
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
