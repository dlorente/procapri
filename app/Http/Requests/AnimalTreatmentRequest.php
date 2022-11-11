<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AnimalTreatmentRequest extends FormRequest
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
            'oc1' => ['required', 'string', 'max:55'],
            'oc2' => ['string', 'max:55', 'nullable'],
            'oc3' => ['string', 'max:55', 'nullable'],
            'oc4' => ['string', 'max:55', 'nullable'],
            'oc5' => ['string', 'max:55', 'nullable'],
            'oc6' => ['string', 'max:55', 'nullable'],
            'ocdata' => ['required', 'date_format:"d/m/Y"'],
            'animal_id' => ['required', 'exists:animal,id'],
        ];
    }

}