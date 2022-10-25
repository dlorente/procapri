<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AnimalRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Retorna as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'anregistro' => ['required'],
            'annome' => ['required'],
            'ananimal' => ['required'],
            'andnasc' => ['required', 'date_format:"d/m/Y"'],
            'anentrada' => ['required', 'date_format:"d/m/Y"'],
            'sexo_id' => ['required', 'exists:sexo,id'],
            'finalidade_id' => ['required', 'exists:finalidade,id'],
            'entrada_id' => ['required', 'exists:entrada,id'],
            'local_id',
            'lote_id',
            'brinco_id',
            'barba_id',
            'corno_id',
            'pelagem_id',
            'sangue_id',
            'raca_id',
            'criador_id',
            'indicaregistro_id',
            'crcodigo',
            'irgcodigo',
            'anpontua',
            'anregpai',
            'anomepai',
            'anregmae',
            'sacodigo',
            'sxcodigo',
            'pecodigo',
            'bacodigo',
            'brcodigo',
            'fnlcodigo',
            'andesmama' => ['nullable', 'date_format:"d/m/Y"'],
            'andcoberta' => ['nullable', 'date_format:"d/m/Y"'],
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
    }

}
