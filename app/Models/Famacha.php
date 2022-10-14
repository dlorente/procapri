<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Famacha extends Model
{
    protected $table = 'famacha';

    protected $fillable = [
        'fanome',
        'faatitudeclinica'
    ];

}
