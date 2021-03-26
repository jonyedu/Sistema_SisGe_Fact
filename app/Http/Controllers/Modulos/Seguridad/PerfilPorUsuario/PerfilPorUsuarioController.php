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
                            'superior' => 1,
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
