<?php

namespace App\Models;

use App\Models\Base\AuthEntity;

class Secretary extends AuthEntity
{
    public $fillable=['last_name','first_name','username','email','password'];

}
