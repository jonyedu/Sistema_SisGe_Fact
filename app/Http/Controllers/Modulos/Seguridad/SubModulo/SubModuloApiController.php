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
    public function cargarSubModuloPorModulo($id){
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
            $subModulo = DB::select("exec SPSEG_OPCION_APLICACION_POR_MODULO ".$id );
            return  response()->json(['subModulo' => $subModulo], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarSubModuloTabla()
    {
        try {
            $subModulo = DB::select("exec SPSEG_OPCION_APLICACION_POR_MODULO_ALL ");
            return  response()->json(['subModulo' => $subModulo], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarSubModulo(Request $request)
    {
        try {
            $user = Auth::user();
            $modulo = $request->input('frm_id_modulo');
            $descripcion = $request->input('frm_sub_descripcion');
            $imagen = $request->input('frm_sub_imagen');
            $tipo = $request->input('frm_sub_tipo');
            $ejecutable = $request->input('frm_sub_ejecutable');
            $usuario_ingreso = $user->codigo;
            $pcname = $_SERVER["REMOTE_ADDR"];
            $status = 1;
            $route = $request->input('frm_sub_ruta');
            DB::insert("exec SPSEG_INSERT_OPCION_APLICACION '', " . "'$modulo'" . ",'$descripcion'" . ",'$imagen'" . ",'$tipo'" . ",'$ejecutable'" . ",'$usuario_ingreso'" . ",'$pcname'" . ",'$status'" . ",'$route'" );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarSubModulo(Request $request)
    {
        try {
            $user = Auth::user();
            $codigo = $request->input('frm_id_sub_modulo');
            $modulo = $request->input('frm_id_modulo');
            $descripcion = $request->input('frm_sub_descripcion');
            $imagen = $request->input('frm_sub_imagen');
            $tipo = $request->input('frm_sub_tipo');
            $ejecutable = $request->input('frm_sub_ejecutable');
            $usuario_modificacion = $user->codigo;
            $pcname = $_SERVER["REMOTE_ADDR"];
            $status = 1;
            $route = $request->input('frm_sub_ruta');
            DB::insert("exec SPSEG_UPDATE_OPCION_APLICACION " . "'$codigo'" . ",'$modulo'" . ",'$descripcion'" . ",'$imagen'" . ",'$tipo'" . ",'$ejecutable'" . ",'$usuario_modificacion'" . ",'$pcname'" . ",'$status'" . ",'$route'" );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarSubModulo($id)
    {
        try {
            DB::update("exec SPSEG_ELIMINAR_OPCION_APLICACION " . "'$id'");
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
