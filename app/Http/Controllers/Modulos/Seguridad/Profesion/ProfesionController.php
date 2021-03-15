<?php

namespace App\Http\Controllers\Modulos\Seguridad\Profesion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulos\Seguridad\Perfil\PerfilRequest;
use App\Http\Requests\Modulos\Seguridad\Profesion\ProfesionRequest;
use App\Models\Modulos\Seguridad\Profesion\Profesion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionController extends Controller
{
    public function cargarProfesionTabla()
    {
        try {
            $profesiones = Profesion::where('status', 1)
                ->orderBy('descripcion', 'asc')
                ->get();
            return  response()->json(['profesiones' => $profesiones], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarProfesion(Request $request)
    {
        try {
            $user = Auth::user();
            Profesion::Create(
                [
                    'descripcion' => $request->input('descripcion'),
                    'abreviatura' => ".",
                    'usu_created_update' => $user->codigo,
                    'status' => 1,
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarProfesion(Request $request)
    {
        try {
            $user = Auth::user();
            Profesion::where('status', 1)
                ->where('codigo', $request->input('profesion_id'))
                ->Update(
                    [
                        'descripcion' => $request->input('descripcion'),
                        'abreviatura' => ".",
                        'usu_created_update' => $user->codigo,
                        'status' => 1,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarProfesion($id)
    {
        try {
            Profesion::where('status', 1)
                ->where('codigo', $id)
                ->Update(
                    [
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
