<?php

namespace App\Models;

use App\Models\BaseModel;

class Lote extends BaseModel
{
    protected $table = 'lote';

    protected $fillable = [
        'criador_id',
        'l1codigo',
        'crcodigo',
        'l1nome',
    ];

    protected $filters = [
        'l1codigo',
        'l1nome',
    ];

}
