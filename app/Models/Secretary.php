<?php

namespace App\Models;

class Secretary extends BaseModel
{
    //protected $guarded = array('password', 'username', 'email');
    //protected $fillable = array('first_name', 'last_name');
    //protected $visible = array('first_name', 'last_name', 'username', 'email');
    //protected $hidden = array('password');

    public function appointments()
    {
        return $this->morphMany('App\Models\Appointment','appointmentable');
    }

}
