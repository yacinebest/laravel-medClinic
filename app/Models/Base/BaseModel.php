<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model ;

class BaseModel extends Model
{
    protected static function boot(){
        parent::boot();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
