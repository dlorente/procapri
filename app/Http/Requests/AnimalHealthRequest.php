<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AnimalHealthRequest extends FormRequest
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
            'doenca_id' => ['required', 'exists:doenca,id'],
            'famacha_id' => ['required', 'exists:famacha,id'],
            'addtinicio' => ['required', 'date_format:"d/m/Y"'],
            'adobs' => ['string', 'max:100', 'nullable'],
        ];
    }

}