<?php

namespace App\Http\Requests\Modulos\Seguridad\Profesion;

use Illuminate\Foundation\Http\FormRequest;

class ProfesionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descripcion' => 'required',
            'abreviatura' => 'required|max:10',
        ];
    }
}
