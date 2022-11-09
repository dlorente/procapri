<?php

namespace App\Models;

use App\Casts\Date;
use App\Models\BaseModel;

class Producao extends BaseModel
{
    protected $table = 'producao';

    protected $fillable = [
        'animal_id',
        'criador_id',
        'ocolact_id',
        'anregistro',
        'crcodigo',
        'prdatacon',
        'prplord1',
        'prplord2',
        'prplord3',
        'prgordura',
        'prproteina',
        'prextseco'
    ];

    protected $filters = [
        'animal.anregistro',
        'animal.ananimal',
        'animal.annome',
    ];

    protected $casts = [
        'prdatacon' => Date::class,
    ]; 

    public function ocoLact()
    {
        return $this->belongsTo(OCOLact::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }
}
