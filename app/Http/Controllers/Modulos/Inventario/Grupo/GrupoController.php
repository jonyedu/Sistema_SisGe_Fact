<?php

namespace App\Http\Controllers\Modulos\Inventario\Grupo;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Inventario\Grupo\Grupo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{
    public function cargarGrupoComboBox()
    {
        try {
            $grupos = Grupo::select('Id', 'Codigo', 'Estado')
                ->where('Estado', 1)
                ->get();
            return  response()->json(['grupos' => $grupos, 'total' => sizeOf($grupos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarGrupoTabla()
    {
        try {
            $grupos = Grupo::where('Estado', 1)
                ->get();
            return  response()->json(['grupos' => $grupos, 'total' => sizeOf($grupos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarModificarGrupo(Request $request)
    {
        try {
            $user = Auth::user();
            Grupo::updateOrCreate(
                [
                    'Id' => $request->input('grupo_id'),
                    'Estado' => 1
                ],
                [
                    'Codigo' => $request->input('codigo'),
                    'Descripcion' => $request->input('descripcion'),
                    'usu_created_update' => $user->codigo,
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'Estado' => 1
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function eliminarGrupo($id)
    {
        try {
            $user = Auth::user();
            Grupo::where('Estado', 1)
                ->where('Id', $id)
                ->Update(
                    [
                        'usu_created_update' => $user->codigo,
                        'pcip' =>  $_SERVER["REMOTE_ADDR"],
                        'Estado' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
