<?php

namespace App\Models;

class Appointment extends BaseModel
{
    //protected $fillable = array('date', 'start_at', 'end_at', 'reason');
    //protected $visible = array('date', 'start_at', 'end_at', 'reason');

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function appointmentable()
    {
        return $this->morphTo();
    }

}
