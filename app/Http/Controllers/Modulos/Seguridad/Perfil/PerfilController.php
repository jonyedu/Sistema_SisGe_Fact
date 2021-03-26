<?php

namespace App\Http\Controllers\Modulos\Seguridad\Perfil;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulos\Seguridad\Perfil\PerfilRequest;
use App\Models\Modulos\Seguridad\Perfil\Perfil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function cargarPerfilComboBox()
    {
        try {
            $perfiles = Perfil::select('codigo','descripcion')
                ->where('status', 1)
                ->orderBy('descripcion', 'asc')
                ->get();
            return  response()->json(['perfiles' => $perfiles], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarPerfilTabla()
    {
        try {
            $perfiles = Perfil::where('status', 1)
                ->orderBy('descripcion', 'asc')
                ->get();
            return  response()->json(['perfiles' => $perfiles], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarPerfil(Request $request)
    {
        try {
            $user = Auth::user();
            Perfil::Create(
                [
                    'descripcion' => $request->input('descripcion'),
                    'abreviatura' => ".",
                    'usuario_ingreso' => $user->codigo,
                    'fecha_ingreso' => date("Y-m-d H:i:s"),
                    'usuario_modificacion' => $user->codigo,
                    'fecha_modificacion' => date("Y-m-d H:i:s"),
                    'pcname' =>  $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarPerfil(Request $request)
    {
        try {
            $user = Auth::user();
            Perfil::where('status', 1)
                ->where('codigo', $request->input('perfil_id'))
                ->Update(
                    [
                        'descripcion' => $request->input('descripcion'),
                        'abreviatura' => ".",
                        'usuario_modificacion' => $user->codigo,
                        'fecha_modificacion' => date("Y-m-d H:i:s"),
                        'pcname' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 1,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarPerfil($id)
    {
        try {
            $user = Auth::user();
            Perfil::where('status', 1)
                ->where('codigo', $id)
                ->Update(
                    [
                        'usuario_modificacion' => $user->codigo,
                        'fecha_modificacion' => date("Y-m-d H:i:s"),
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
