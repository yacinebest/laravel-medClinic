<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class PrescriptionLine extends BaseModel
{
    public $fillable=['medicine','dose','time_taken','duration','prescription_id'];
    public function prescription()
    {
        return $this->belongsTo('App\Models\Prescription');
    }
}
