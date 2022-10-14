<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicaRegistro extends Model
{
    protected $table = 'indicaregistro';

    protected $fillable = [
        'irgnome',
    ];

}
