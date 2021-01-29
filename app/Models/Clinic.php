<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Clinic extends BaseModel
{
    public $fillable=['name','address','phone_number'];
}
