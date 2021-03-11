<?php

namespace App\Http\Controllers\Modulos\Administracion\Laboratorio;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Administracion\Laboratorio\Laboratorio;

use Exception;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function cargarLaboratorioCombo()
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

    public function cargarLaboratorioAll()
    {
        try {
            $laboratorios = Laboratorio::select('id',  'codigo','nombre',  'representante','direcion',
            'telefono','estado')
                ->where('estado', 1)
                ->get();
            return  response()->json(['laboratorios' => $laboratorios, 'total' => sizeOf($laboratorios)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    public function guardarModificarLaboratorio(Request $request)
    {
       //return  response()->json(['datos' => $request->input()]);
        try {
           // $user = Auth::user();
            Laboratorio::updateOrCreate(
                [
                    'id' => $request->input('laboratorio_id'),
                 
                ],
                [
                    
                    'codigo' => $request->input('codigo'),
                    'nombre' => $request->input('nombre'),
                    'representante' => $request->input('representante'),
                    'direcion' => $request->input('direccion'),
                    'telefono' => $request->input('telefono'),
                    'estado' => $request->input('estado')
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
