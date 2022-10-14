<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parto extends Model
{
    protected $table = 'parto';

    protected $fillable = [
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

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }
}
