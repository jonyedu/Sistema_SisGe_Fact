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
            return  response()->json(['usuarios' => $usuarios], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function guardarUsuario(UsuarioRequest $request)
    {
        try {
            $user = Auth::user();
            SegUsuario::Create(
                [
                    'nombre' => $request->input('nombre'),
                    'apellido' => $request->input('apellido'),
                    'usuario' => $request->input('usuario'),
                    'password' => Hash::make($request->input('password')),
                    'perfil' => $request->input('id_perfil'),
                    'profesion' => $request->input('id_profesion'),
                    'abreviatura' => $request->input('iniciales'),
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
    public function modificarUsuario(UsuarioRequest $request)
    {
        try {
            $user = Auth::user();
            SegUsuario::where('status', 1)
                ->where('codigo', $request->input('codigo'))
                ->Update(
                    [
                        'nombre' => $request->input('nombre'),
                        'apellido' => $request->input('apellido'),
                        'usuario' => $request->input('usuario'),
                        'password' => Hash::make($request->input('password')),
                        'perfil' => $request->input('id_perfil'),
                        'profesion' => $request->input('id_profesion'),
                        'abreviatura' => $request->input('iniciales'),
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
                        'pcname' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
