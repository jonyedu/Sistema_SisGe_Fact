<?php

namespace App\Http\Controllers\Modulos\Persona\Proveedor;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Persona\Proveedor\Proveedor;

use Exception;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function cargarProveedorComboBox()
    {
        try {
            $proveedores = Proveedor::select('id', 'nombre', 'estado')
                ->where('estado', 1)
                ->get();
            return  response()->json(['proveedores' => $proveedores, 'total' => sizeOf($proveedores)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarProveedorAll()
    {
        try {
            $proveedores = Proveedor::select('id',  'codigo','nombre',  'representante','direcion',
            'telefono','estado')
                ->where('estado', 1)
                ->get();
            return  response()->json(['proveedores' => $proveedores, 'total' => sizeOf($proveedores)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    public function guardarModificarProveedor(Request $request)
    {
       //return  response()->json(['datos' => $request->input()]);
        try {
           // $user = Auth::user();
            Proveedor::updateOrCreate(
                [
                    'id' => $request->input('Proveedor_id'),

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
