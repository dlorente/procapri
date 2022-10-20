<?php

namespace App\Models;

use App\Casts\Date;

class Animal extends BaseModel
{
    protected $table = 'animal';

    protected $fillable = [
        'agnome',
    ];

    protected $casts = [
        'andnasc' => Date::class,
        'anentrada' => Date::class,
        'andesmama' => Date::class,
        'andcoberta' => Date::class,
    ];

}
