<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doenca extends Model
{
    protected $table = 'doenca';

    protected $fillable = [
        'nomedoenca',
    ];

    public function agente()
    {
        return $this->belongsTo(Agente::class);
    }
}
