<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criador extends Model
{
    protected $table = 'criador';

    protected $fillable = [
        'agnome',
    ];

}
