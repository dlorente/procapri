<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFinal extends Model
{
    protected $table = 'tfinal';

    protected $fillable = [
        'fnlsexo',
        'fnlnome'
    ];

}
