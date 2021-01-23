<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Carbon\Carbon;

class Appointment extends BaseModel
{
    public $fillable=['date','reason','start_at','end_at','patient_id','doctor_id'];
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

}
