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
            $productos = Producto::with('laboratorio:id,nombre', 'grupo:Id,codigo')
                ->get();
            return  response()->json(['productos' => $productos, 'total' => sizeOf($productos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarProducto(Request $request)
    {
        try {
            Producto::Create(
                [
                    'codigo' => $request->input('codigo'),
                    'nombre' => $request->input('nombre'),
                    'nombrecorto' => $request->input('nombrecorto'),
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
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function actualizarProducto(Request $request)
    {
        try {
            Producto::where('id', $request->input('producto_id'))
                ->Update(
                    [
                        'codigo' => $request->input('codigo'),
                        'nombre' => $request->input('nombre'),
                        'nombrecorto' => $request->input('nombrecorto'),
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
                ->where('codigo', $id)
                ->Update(
                    [
                        'usuario_modificacion' => $user->codigo,
                        'fecha_modificacion' => date("Y-m-d H:i:s"),
                        'pcname' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
