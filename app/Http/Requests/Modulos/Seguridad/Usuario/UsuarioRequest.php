<?php

namespace App\Http\Requests\Modulos\Seguridad\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UsuarioRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'apellido' => 'required',
            'nombre' => 'required',
            'profesion_id' => 'required',
            'usuario' => 'required',
            'password' => 'required|string|min:8|max:12|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|',//regex:/[-@$!%*#?&]/
            'password_confirmation' => 'required|string|min:8|max:12',
            'id_perfil' => 'required',
            'iniciales' => 'required|max:10',
            'email' => 'required|string|email|unique:SEG_USUARIO,email,' . $this->codigo . ',codigo',
        ];
    }
}
