<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ADMed extends Model
{
    protected $table = 'admed';

    protected $fillable = [
        'addtinicio',
        'anregistro',

    ];

}
