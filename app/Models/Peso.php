<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    protected $table = 'peso';

    protected $fillable = [
        'anregistro',
        'pedatapes',
        'pepeso',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

}
