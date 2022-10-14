<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotSaida extends Model
{
    protected $table = 'motsaida';

    protected $fillable = [
        'msnome',
    ];

}
