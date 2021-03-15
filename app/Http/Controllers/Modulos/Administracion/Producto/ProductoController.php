<?php

namespace App\Http\Controllers\Modulos\Administracion\Producto;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Administracion\Producto\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function cargarProductoTabla()
    {
        try {
            $productos = Producto::where('status', 1)
                ->with('laboratorio:id,nombre', 'grupo:Id,codigo')
                ->get();
            return  response()->json(['productos' => $productos, 'total' => sizeOf($productos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarModificarProducto(Request $request)
    {
        //return  response()->json(['datos' => $request->input()]);
        try {
            $user = Auth::user();
            Producto::updateOrCreate(
                [
                    'id' => $request->input('producto_id'),
                    'status' => 1
                ],
                [
                    'codigo' => $request->input('codigo'),
                    'nombre' => $request->input('nombre'),
                    'nombrecorto' => $request->input('nombre_corto'),
                    'descripcion' => $request->input('descripcion'),
                    'posologia' => $request->input('posologia'),
                    'contraindicacion' => $request->input('contraindicacion'),
                    'grupo_id' => $request->input('grupo_id'),
                    'laboratorio_id' => $request->input('laboratorio_id'),
                    'stock_maximo' => $request->input('stock_maximo'),
                    'stock_minimo' => $request->input('stock_minimo'),
                    'pvc' => $request->input('pvc'),
                    'generico' => $request->input('generico'),
                    'refrigeracion' => $request->input('refrigeracion'),
                    'iva' => $request->input('iva'),
                    'imagen' => $request->input('imagen'),
                    'usu_created_update' => $user->codigo,
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function eliminarProducto($id)
    {
        try {
            $user = Auth::user();
            Producto::where('status', 1)
                ->where('id', $id)
                ->Update(
                    [
                        'usu_created_update' => $user->codigo,
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
