<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producao extends Model
{
    protected $table = 'semen';

    protected $fillable = [
        'prdatacon',
        'prplord1',
        'prplord2',
        'prplord3',
        'prgordura',
        'prproteina',
        'prextseco'
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
