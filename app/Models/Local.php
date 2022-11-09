<?php

namespace App\Models;

use App\Models\BaseModel;


class Local extends BaseModel
{
    protected $table = 'local';

    protected $fillable = [
        'criador_id',
        'l2codigo',
        'crcodigo',
        'l2nome',
    ];

    protected $filters = [
        'l2codigo',
        'l2nome',
    ];

}
