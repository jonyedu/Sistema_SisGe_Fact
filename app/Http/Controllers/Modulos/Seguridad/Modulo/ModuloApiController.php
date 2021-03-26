<?php

namespace App\Http\Controllers\Modulos\Seguridad\Modulo;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Seguridad\Modulo\SgModulo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModuloApiController extends Controller
{
    public function cargarMenu()
    {
        try {
            $menus = SgModulo::where('status', 1)
                ->with('subModulo')
                ->with(['subModulo' => function ($i) {
                    $i->where('status', 1);
                }])
                ->orderBy('orden', 'asc')
                ->get();
            return  response()->json(['menus' => $menus], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarModuloTabla()
    {
        try {
            $modulos = SgModulo::where('status', 1)
                ->get();
            return  response()->json(['modulos' => $modulos, 'total' => $modulos->count()], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarModuloComboBox()
    {
        try {
            $modulos = SgModulo::select('codigo','descripcion')
                ->where('status', 1)
                ->get();
            return  response()->json(['modulos' => $modulos], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarModulo(Request $request)
    {
        try {
            $user = Auth::user();
            SgModulo::Create(
                [
                    'empresa' => $request->input('empresa_id'),
                    'sucursal' => $request->input('sucursal_id'),
                    'descripcion' => $request->input('descripcion'),
                    'abreviatura' => ".",
                    'usuario_ingreso' => $user->codigo,
                    'fecha_ingreso' => date("Y-m-d H:i:s"),
                    'usuario_modificacion' => $user->codigo,
                    'fecha_modificacion' => date("Y-m-d H:i:s"),
                    'pcname' =>  $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                    'imagen' => $request->input('imagen'),
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarModulo(Request $request)
    {
        try {
            $user = Auth::user();
            SgModulo::where('status', 1)
                ->where('codigo', $request->input('modulo_id'))
                ->Update(
                    [
                        'empresa' => $request->input('empresa_id'),
                        'sucursal' => $request->input('sucursal_id'),
                        'descripcion' => $request->input('descripcion'),
                        'abreviatura' => ".",
                        'usuario_modificacion' => $user->codigo,
                        'fecha_modificacion' => date("Y-m-d H:i:s"),
                        'pcname' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 1,
                        'imagen' => $request->input('imagen'),
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarModulo($id)
    {
        try {
            $user = Auth::user();
            SgModulo::where('status', 1)
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
