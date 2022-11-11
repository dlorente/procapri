<?php

namespace App\Models;

use App\Casts\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ocorre extends BaseModel
{
    protected $table = 'ocorre';

    protected $fillable = [
        'oc1',
        'oc6',
        'oc2',
        'oc3',
        'oc4',
        'oc5',
        'ocdata',
        'crcodigo',
        'anregistro',
        'animal_id',
    ];

    protected $filters = [
        'animal.anregistro',
        'animal.ananimal',
        'animal.annome',
        'oc1',
        'oc6',
        'oc2',
        'oc3',
        'oc4',
        'oc5',
    ];

    protected $casts = [
        'ocdata' => Date::class,
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
