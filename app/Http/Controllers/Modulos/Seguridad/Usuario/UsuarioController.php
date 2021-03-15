<?php

namespace App\Http\Controllers\Modulos\Seguridad\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulos\Seguridad\Usuario\UsuarioRequest;
use App\Models\Modulos\Seguridad\Usuario\SegUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function cargarUsuarioTabla()
    {
        try {
            $usuarios = SegUsuario::where('status', 1)
                ->with('perfil', 'profesion')
                ->orderBy('nombre', 'asc')
                ->get();
            return  response()->json(['usuarios' => $usuarios, 'total' => $usuarios->count()], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function guardarUsuario(Request $request)
    {
        try {
            $user = Auth::user();
            SegUsuario::Create(
                [
                    'nombre' => $request->input('nombre'),
                    'apellido' => $request->input('apellido'),
                    'usuario' => $request->input('usuario'),
                    'password' => Hash::make($request->input('contrasenia')),
                    'perfil' => $request->input('perfil_id'),
                    'profesion' => $request->input('profesion_id'),
                    'abreviatura' => ".",
                    'usr_ingreso' => $user->codigo,
                    'fec_ingreso' => date("Y-m-d H:i:s"),
                    'usr_modificacion' => $user->codigo,
                    'fec_modificacion' => date("Y-m-d H:i:s"),
                    'pc_name' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                    'PermitirAnular' => 1,
                    'email' => $request->input('email'),
                ]
            );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarUsuario(Request $request)
    {
        return  response()->json(['msj' => $request->input()], 200);
        try {
            $user = Auth::user();
            SegUsuario::where('status', 1)
                ->where('codigo', $request->input('usuario_id'))
                ->Update(
                    [
                        'nombre' => $request->input('nombre'),
                        'apellido' => $request->input('apellido'),
                        'usuario' => $request->input('usuario'),
                        'password' => Hash::make($request->input('contrasenia')),
                        'perfil' => $request->input('perfil_id'),
                        'profesion' => $request->input('profesion_id'),
                        'abreviatura' => ".",
                        'usr_modificacion' => $user->codigo,
                        'fec_modificacion' => date("Y-m-d H:i:s"),
                        'pc_name' => $_SERVER["REMOTE_ADDR"],
                        'status' => 1,
                        'PermitirAnular' => 1,
                        'email' => $request->input('email'),
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarUsuario($id)
    {
        try {
            $user = Auth::user();
            SegUsuario::where('status', 1)
                ->where('codigo', $id)
                ->Update(
                    [
                        'usr_modificacion' => $user->codigo,
                        'fec_modificacion' => date("Y-m-d H:i:s"),
                        'pc_name' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
