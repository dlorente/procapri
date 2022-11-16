<?php

namespace App\Models;

use App\Models\BaseModel;

class MotSaida extends BaseModel
{
    protected $table = 'motsaida';

    protected $fillable = [
        'msnome',
    ];

}
