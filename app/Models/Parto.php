<?php

namespace App\Models;

use App\Casts\Date;
use App\Models\BaseModel;

class Parto extends BaseModel
{
    protected $table = 'parto';

    protected $fillable = [
        'anregistro',
        'crcodigo',
        'animal_id',
        'criador_id',
        'encerra_id',
        'tpparto_id',
        'padatapar',
        'paordem',
        'pacodigo',
        'panucrias',
        'panubode',
        'padultcob',
        'cobcodigo',
        'ciocodigo',
        'panciocob',
        'pancioncob',
        'padenclac',
        'eccodigo',
        'paprtolei',
        'patprotei',
        'patgordura',
        'paextseco',
        'paprmaxima',
        'paprminima',
    ];

    protected $filters = [
        'animal.anregistro',
        'animal.ananimal',
        'animal.annome',
    ];

    protected $casts = [
        'padatapar' => Date::class,
        'padultcob' => Date::class,
        'padenclac' => Date::class,
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }

    public static function nextParturitionNumber($animal_id)
    {
        $max_p = Parto::where('animal_id', $animal_id)
            ->where('criador_id', auth()->user()->farmerId())
            ->max('paordem');
        
        return $max_p + 1;
    }
}
