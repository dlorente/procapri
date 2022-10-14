<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPCio extends Model
{
    protected $table = 'tpcio';

    protected $fillable = [
        'cionome',
    ];

}
