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
            $grupos = Grupo::select('id', 'descripcion', 'status')
                ->where('status', 1)
                ->get();
            return  response()->json(['grupos' => $grupos, 'total' => sizeOf($grupos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarGrupoTabla()
    {
        try {
            $grupos = Grupo::where('status', 1)
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
                    'id' => $request->input('grupo_id'),
                    'status' => 1
                ],
                [
                    'codigo' => $request->input('codigo'),
                    'descripcion' => $request->input('descripcion'),
                    'usu_created' => $user->codigo,
                    'usu_update' => $user->codigo,
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1
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
            Grupo::where('status', 1)
                ->where('id', $id)
                ->Update(
                    [
                        'usu_update' => $user->codigo,
                        'pcip' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
