<?php

namespace App\Models;

use App\Models\Base\AuthEntity;

class Secretary extends AuthEntity
{

    public function appointments()
    {
        return $this->morphMany('App\Models\Appointment','appointmentable');
    }

}
