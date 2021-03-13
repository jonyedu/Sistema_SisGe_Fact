<?php

namespace App\Http\Controllers\Modulos\Administracion\Laboratorio;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Administracion\Laboratorio\Laboratorio;
use Exception;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function cargarLaboratorioComboBox()
    {
        try {
            $laboratorios = Laboratorio::select('id', 'nombre', 'estado')
                ->where('estado', 1)
                ->get();
            return  response()->json(['laboratorios' => $laboratorios, 'total' => sizeOf($laboratorios)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
