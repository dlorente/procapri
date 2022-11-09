<?php

namespace App\Models;

use App\Casts\Date;
use App\Models\BaseModel;

class Peso extends BaseModel
{
    protected $table = 'peso';

    protected $fillable = [
        'anregistro',
        'crcodigo',
        'pedatapes',
        'pepeso',
        'criador_id',
        'animal_id',
    ];

    protected $filters = [
        'animal.anregistro',
        'animal.ananimal',
        'animal.annome',
    ];

    protected $casts = [
        'pedatapes' => Date::class,
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

}
