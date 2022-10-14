<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrauSangue extends Model
{
    protected $table = 'grausangue';

    protected $fillable = [
        'racodigo',
        'gsaporcsangue',
        'oc2',
        'oc3',
        'oc4',
        'oc5',
        'oc6',
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
