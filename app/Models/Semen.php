<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semen extends Model
{
    protected $table = 'semen';

    protected $fillable = [
        'smdata',
        'smindice',
        'smnfiscal',
        'smndose',
        'smpreco',
        'smfinal',
        'smobs',
    ];

    public function finalSemen()
    {
        return $this->belongsTo(FinalSemen::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }
}
