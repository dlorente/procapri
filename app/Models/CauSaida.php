<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauSaida extends Model
{
    protected $table = 'agente';

    protected $fillable = [
        'csnome',
    ];

}
