<?php

namespace App\Models;

use App\Casts\Date;
use App\Models\BaseModel;

class AnimalDoenca extends BaseModel
{
    protected $table = 'animaldoenca';

    protected $fillable = [
        'animal_id',
        'doenca_id',
        'famacha_id',
        'addtinicio',
        'anregistro',
        'crcodigo',
        'coddoenca',
        'adobs',
        'facodigo',
    ];

    protected $filters = [
        'animal.anregistro',
        'animal.ananimal',
        'animal.annome',
        'doenca.nomedoenca',
    ];

    protected $casts = [
        'addtinicio' => Date::class,
    ];

    public function doenca()
    {
        return $this->belongsTo(Doenca::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
