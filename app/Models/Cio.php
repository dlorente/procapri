<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cio extends Model
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

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }

}
