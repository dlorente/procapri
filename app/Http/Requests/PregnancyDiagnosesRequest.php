<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class PregnancyDiagnosesRequest extends FormRequest
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
            'cidtdiagnosticogest' => ['required', 'date_format:"d/m/Y"'],
            'citempoprovgest' => ['required', 'integer'],
            'cinumfetosgest' => ['required', 'integer'],
            'cpcodigo' => ['required'],
            'tpexgest_id' => ['required', 'exists:tpexgest,id'],
            'animal_id' => ['required', 'exists:animal,id'],
        ];
    }

}