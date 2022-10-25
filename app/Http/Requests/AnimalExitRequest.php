<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AnimalExitRequest extends FormRequest
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
            'andatasai' => ['required', 'date_format:"d/m/Y"'],
            'motsaida_id' => ['required', 'exists:motsaida,id'],
            'causaida_id' => ['required', 'exists:causaida,id'],
        ];
    }

}
