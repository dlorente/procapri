<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelagem extends Model
{
    protected $table = 'pelagem';

    protected $fillable = [
        'penome',
    ];

}
