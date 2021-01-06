<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Imagery extends BaseModel
{

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

}
