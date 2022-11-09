<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class OldLoginFormRequest extends FormRequest
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
            'crcodigo' => ['required', 'max:5'],
            'crnome' => ['required'],
            'crprop' => ['required'],
            'crendereco' => ['required'],
            'crcep1' => ['required'],
            'crmunic' => ['required'],
            'crestado' => ['required'],
            'crcorrespc' => ['required'],
            'crcepc1' => ['required'],
            'crcidadec' => ['required'],
            'crestadoc' => ['required'],
        ];
    }

}
