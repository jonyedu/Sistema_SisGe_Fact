<?php

namespace App\Http\Controllers\Modulos\Seguridad\PerfilPorUsuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuarioRequest;
use App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion;
use App\Models\Modulos\Seguridad\Modulo\SgModulo;
use App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario;
use App\Models\Modulos\Seguridad\Usuario\SegUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilPorUsuarioController extends Controller
{
    public function cargarMenu($idPerfil)
    {
        try {
            $idModulo = [];
            $idOpcionAplicacion = [];
            $menus = [];
            $arrayModulos = PerfilPorUsuario::where('status', 1)
                ->where('perfil', $idPerfil)
                ->orderBy('modulo', 'asc')
                ->get();

            //return  response()->json(['arrayModulos' =>  $arrayModulos], 200);
            foreach ($arrayModulos as $modulo) {
                $existe = array_key_exists($modulo->modulo, $idModulo);
                if ($existe == false) {
                    array_push($idModulo, $modulo->modulo);
                }
                /* if (!array_key_exists($modulo->opcion_aplicacion, $idOpcionAplicacion)) {
                    array_push($idOpcionAplicacion, $modulo->opcion_aplicacion);
                } */
                array_push($idOpcionAplicacion, $modulo->opcion_aplicacion);
            }
            //return  response()->json(['idModulo' =>  $idModulo], 200);

            $menus = SgModulo::where('status', 1)
                ->whereIn('codigo', $idModulo)
                ->with(['subModulo' => function ($i)  use ($idOpcionAplicacion) {
                    $i->whereIn('codigo', $idOpcionAplicacion);
                }])
                ->get();
            return  response()->json(['menus' =>  $menus], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarMenu1($idPerfil)
    {
        try {
            $idModulo = [];
            $idOpcionAplicacion = [];
            $menus = [];
            $arrayModulos = PerfilPorUsuario::where('status', 1)
                ->where('perfil', $idPerfil)
                ->get();


            foreach ($arrayModulos as $modulo) {
                if (!array_key_exists($modulo->modulo, $idModulo)) {
                    array_push($idModulo, $modulo->modulo);
                }
                /* if (!array_key_exists($modulo->opcion_aplicacion, $idOpcionAplicacion)) {
                    array_push($idOpcionAplicacion, $modulo->opcion_aplicacion);
                } */
                array_push($idOpcionAplicacion, $modulo->opcion_aplicacion);
            }
            return  response()->json(['idModulo' =>  $idModulo], 200);

            $menus = SgModulo::where('status', 1)
                ->whereIn('codigo', $idModulo)
                ->with(['subModulo' => function ($i)  use ($idOpcionAplicacion) {
                    $i->whereIn('codigo', $idOpcionAplicacion);
                }])
                ->get();
            return  response()->json(['menus' =>  $menus], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    public function cargarPerfilPorUsuario($idModulo, $idPerfil)
    {
        try {
            $subModulos = SgOpcionAplicacion::where('status', 1)
                ->where('modulo', $idModulo)
                ->get();
            $perfilPorUsuarios = PerfilPorUsuario::where('status', 1)
                ->where('perfil', $idPerfil)
                ->where('modulo', $idModulo)
                ->with('subModulo')
                ->get();

            return  response()->json(['subModulos' =>  $subModulos, 'perfilPorUsuarios' => $perfilPorUsuarios], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function actualizarPerfilPorUsuario(Request $request)
    {
        try {
            $user = Auth::user();
            PerfilPorUsuario::where('status', 1)
                ->where('perfil', $request->input('perfil_id'))
                ->where('modulo', $request->input('modulo_id'))
                ->delete();
            $arraySubModulos = $request->input('selectedPerfilPorModulo');
            if (sizeOf($arraySubModulos) > 0) {
                foreach ($arraySubModulos as $subModulo) {
                    PerfilPorUsuario::Create(
                        [
                            'empresa' => 1,
                            'sucursal' => 1,
                            'perfil' => $request->input('perfil_id'),
                            'modulo' => $request->input('modulo_id'),
                            'opcion_aplicacion' => $subModulo,
                            'usu_created' => $user->codigo,
                            'usu_update' => $user->codigo,
                            'pcip' =>  $_SERVER["REMOTE_ADDR"],
                            'status' => 1,
                        ]
                    );
                }
            }


            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
