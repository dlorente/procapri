<?php

namespace App\Models;

use App\Casts\Date;
use App\Casts\DateTime;
use PhpParser\Node\Expr\Cast;

class Animal extends BaseModel
{
    protected $table = 'animal';

    protected $fillable = [
        'local_id',
        'lote_id',
        'brinco_id',
        'barba_id',
        'corno_id',
        'pelagem_id',
        'sangue_id',
        'raca_id',
        'criador_id',
        'sexo_id',
        'entrada_id',
        'finalidade_id',
        'indicaregistro_id',
        'anregistro',
        'crcodigo',
        'ananimal',
        'irgcodigo',
        'anpontua',
        'annome',
        'anregpai',
        'anomepai',
        'anregmae',
        'andnasc',
        'sacodigo',
        'sxcodigo',
        'pecodigo',
        'bacodigo',
        'brcodigo',
        'fnlcodigo',
        'andesmama',
        'andcoberta',
        'anentrada',
        'encodigo',
        'andatasai',
        'mscodigo',
        'cscodigo',
        'anorigem',
        'l1codigo',
        'l2codigo',
        'l3codigo',
        'racodigo',
        'anomemae',
        'corcodigo',

    ];

    protected $filters = [
        'anregistro',
        'ananimal',
        'annome',
        'sexo.sxnome',
      ];

    protected $casts = [
        'andnasc' => Date::class,
        'anentrada' => Date::class,
        'andesmama' => Date::class,
        'andcoberta' => Date::class,
        'andatasai' => Date::class,
        'cidata' => Date::class,
    ];

    public function sexo()
    {
        return $this->belongsTo(Sexo::class);
    }

    public function motivoSaida()
    {
        return $this->belongsTo(MotSaida::class);
    }

    public function entrada()
    {
        return $this->belongsTo(Entrada::class);
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function causaSaida()
    {
        return $this->belongsTo(CauSaida::class);
    }

    public function finalidade()
    {
        return $this->belongsTo(Finalidade::class);
    }

    public function cio()
    {
        return $this->hasMany(Cio::class);
    }

}
