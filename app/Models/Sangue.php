<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sangue extends Model
{
    protected $table = 'sangue';

    protected $fillable = [
        'sanome',
    ];

}
