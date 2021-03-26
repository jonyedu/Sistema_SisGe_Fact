<?php

namespace App\Http\Controllers\Modulos\Seguridad\SubModulo;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubModuloApiController extends Controller
{
    public function cargarSubModuloPorModulo($id)
    {
        try {
            $subModulos = SgOpcionAplicacion::where('status', 1)
                ->orderBy('descripcion', 'asc')
                ->where('modulo', $id)
                ->get();
            return  response()->json(['subModulos' => $subModulos], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarSubModuloComboBox($id)
    {
        try {
            $subModulo = DB::select("exec SPSEG_OPCION_APLICACION_POR_MODULO " . $id);
            return  response()->json(['subModulo' => $subModulo], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarSubModuloTabla()
    {
        try {
            $subModulos = SgOpcionAplicacion::where('status', 1)
                ->with('modulo:codigo,descripcion')
                ->get();
            return  response()->json(['subModulos' => $subModulos, 'total'=> $subModulos->count()], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarSubModulo(Request $request)
    {
        try {
            $user = Auth::user();
            SgOpcionAplicacion::Create(
                [
                    'empresa' => $request->input('empresa_id'),
                    'sucursal' => $request->input('sucursal_id'),
                    'modulo' => $request->input('modulo_id'),
                    'descripcion' => $request->input('descripcion'),
                    'imagen' => $request->input('imagen'),
                    'tipo' => 0,
                    'ejecutable' => ".",
                    'usuario_ingreso' => $user->codigo,
                    'fecha_ingreso' => date("Y-m-d H:i:s"),
                    'usuario_modificacion' => $user->codigo,
                    'fecha_modificacion' => date("Y-m-d H:i:s"),
                    'pcname' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                    'route' => $request->input('ruta'),
                ]
            );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarSubModulo(Request $request)
    {
        try {
            //return  response()->json(['msj' => $request->input()], 200);
            $user = Auth::user();
            SgOpcionAplicacion::where('codigo', $request->input('sub_modulo_id'))->update(
                [
                    'empresa' => $request->input('empresa_id'),
                    'sucursal' => $request->input('sucursal_id'),
                    'modulo' => $request->input('modulo_id'),
                    'descripcion' => $request->input('descripcion'),
                    'imagen' => $request->input('imagen'),
                    'tipo' => 0,
                    'ejecutable' => ".",
                    'usuario_modificacion' => $user->codigo,
                    'fecha_modificacion' => date("Y-m-d H:i:s"),
                    'pcname' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                    'route' => $request->input('ruta'),
                ]
            );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarSubModulo($id)
    {
        try {
            $user = Auth::user();
            SgOpcionAplicacion::where('status', 1)
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
