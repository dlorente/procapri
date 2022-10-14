<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corno extends Model
{
    protected $table = 'cornos';

    protected $fillable = [
        'crnome',
    ];

}
