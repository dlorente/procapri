<?php

namespace App\Models;

use App\Casts\Date;
use App\Models\BaseModel;

class Cio extends BaseModel
{
    protected $table = 'cio';

    protected $fillable = [
        'cidata',
        'ciocodigo',
        'cicobertu',
        'cobcodigo',
        'cidose',
        'cinanimal',
        'cidatapre',
        'ciresulta',
        'cidataprefinal',
        'citempoprovgest',
        'cinumfetosgest',
        'cidtdiagnosticogest',
        'exgcodigo',
        'tmcodigo',
        'cpcodigo',
        'ciflag',
    ];

    protected $filters = [
        'animal.anregistro',
        'animal.ananimal',
        'animal.annome',
    ];

    protected $casts = [
        'cicobertu' => Date::class,
        'cidata' => Date::class,
        'cidatapre' => Date::class,
        'cidtdiagnosticogest' => Date::class,
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }

    
}
