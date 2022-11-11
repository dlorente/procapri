<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPParto extends BaseModel
{
    protected $table = 'tpparto';

    protected $fillable = [
        'panome',
    ];

}
