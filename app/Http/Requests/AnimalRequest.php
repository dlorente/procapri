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
        ];
    }

}
