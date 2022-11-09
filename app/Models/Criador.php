<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criador extends Model
{
    protected $table = 'criador';

    protected $fillable = [
        'user_id',
        'crcodigo',
        'crnome',
        'crprop',
        'crfazenda',
        'crendereco',
        'crcep1',
        'crmunic',
        'crestado',
        'crpostal',
        'crfonef',
        'crcorrespc',
        'crbairroc',
        'crcepc1',
        'crcidadec',
        'crestadoc',
        'crfonec',
        'crfaxc',
        'crpostalc',
        'crdtregistro',
        'crdtvalidade',
    ];

    protected $filters = [
        'crnome',
        'crprop',
        'crfazenda',
    ];

    protected $casts = [
        'crdtregistro' => Date::class,
        'crdtvalidade' => Date::class,
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
