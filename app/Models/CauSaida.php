<?php

namespace App\Models;

use App\Models\BaseModel;

class CauSaida extends BaseModel
{
    protected $table = 'causaida';

    protected $fillable = [
        'csnome',
    ];

}
