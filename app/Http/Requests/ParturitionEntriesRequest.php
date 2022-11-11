<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ParturitionEntriesRequest extends FormRequest
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
            'animal_id' => ['required', 'exists:animal,id'],
            "anregistro" => ['required'],
            "padultcob" => ['required', 'date_format:"d/m/Y"'],
            "paordem" => ['required', 'integer'],
            "padatapar" => ['required', 'date_format:"d/m/Y"'],
            "tpparto_id" => ['required', 'exists:tpparto,id'],
            "tpcio_id" => ['required', 'exists:tpcio,id'],
            "tpcobertura_id" => ['required', 'exists:tpcobertura,id'],
        ];
    }

}