<?php

namespace App\Http\Controllers\Modulos\Administracion\Grupo;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Administracion\Grupo\Grupo;
use Exception;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function cargarGrupoCombo()
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
}
