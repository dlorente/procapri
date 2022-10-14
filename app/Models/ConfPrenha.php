<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfPrenha extends Model
{
    protected $table = 'confprenha';

    protected $fillable = [
        'cpnome',
    ];

}
