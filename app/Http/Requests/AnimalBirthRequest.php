<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AnimalBirthRequest extends FormRequest
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
            'padatapar' => ['required', 'date_format:"d/m/Y"'],
            'animal_id' => ['required', 'exists:animal,id'],
        ];
    }

}
