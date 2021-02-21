<?php

namespace App\Http\Requests\Modulos\Seguridad\PerfilPorUsuario;

use Illuminate\Foundation\Http\FormRequest;

class PerfilPorUsuarioRequest extends FormRequest
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
            'id_modulo' => 'required',
            'id_perfil' => 'required',
        ];
    }
}
