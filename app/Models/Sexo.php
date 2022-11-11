<?php

namespace App\Models;

use App\Models\BaseModel;

class Sexo extends BaseModel
{
    protected $table = 'sexo';

    protected $fillable = [
        'sxnome',
    ];

}
