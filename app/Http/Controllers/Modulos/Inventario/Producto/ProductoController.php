<?php

namespace App\Http\Controllers\Modulos\Inventario\Producto;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Inventario\Producto\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Modulos\Inventario\Producto\ProductoCosto;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;

class ProductoController extends Controller
{
    public function verificarStockProductoAll()
    {
        try {
            $productos = Producto::select('id', 'nombre', 'stock_minimo')
                ->where('status', 1)
                ->withCount([
                    'productoInventarioMany AS stock' => function ($query) {
                        $query->select(DB::raw("SUM(stock) as paidsum"));
                    }
                ])
                ->get();
            return  response()->json(['productos' => $productos, 'total' => sizeOf($productos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarProductoInventarioComboBox()
    {
        try {
            $producto_inventario = DB::select("call spStock");

            return  response()->json(['producto_inventario' => $producto_inventario, 'total' => sizeOf($producto_inventario)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarProductoInventarioComboBox1()
    {
        try {
            $producto_inventario = Producto::select(
                'id',
                'pvc',
                'nombre',
                'iva',
            )
                ->where('status', 1)
                ->withCount([
                    'productoInventarioMany AS stock' => function ($query) {
                        return $query->select(DB::raw("SUM(stock) as paidsum"));
                    }
                ])
                ->get();

            $filtered = $producto_inventario->filter(function ($value, $key) {
                return $value->stock != null;
            });

            return  response()->json(['producto_inventario' => $filtered, 'total' => sizeOf($filtered)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarProductoTabla()
    {
        try {
            $productos = Producto::select('id', 'codigo', 'pvc', 'nombre', 'nombrecorto', 'descripcion', 'stock_maximo', 'stock_minimo', 'iva', 'grupo_id', 'laboratorio_id', 'imagen')
                ->where('status', 1)
                ->with('proveedor:id,razon_social', 'grupo:id,descripcion')
                ->withCount([
                    'productoInventarioMany AS stock' => function ($query) {
                        $query->select(DB::raw("SUM(stock) as paidsum"));
                    }
                ])
                ->get();
            return  response()->json(['productos' => $productos, 'total' => sizeOf($productos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarProductoPorId($id)
    {
        //return  response()->json(['id' => $id], 200);
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
                    'laboratorio_id' => $request->input('proveedor_id'),
                    'stock_maximo' => $request->input('stock_maximo'),
                    'stock_minimo' => $request->input('stock_minimo'),
                    'pvc' => $request->input('pvc'),
                    'generico' => $request->input('generico'),
                    'refrigeracion' => $request->input('refrigeracion'),
                    'iva' => $request->input('iva'),
                    'imagen' => $request->input('file_base_64'),
                    'usu_created_update' => $user->codigo,
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1
                ]
            );
            $costos_productos = $request->input('productosCarrito._items');
            foreach ($costos_productos as $costo_producto) {
                ProductoCosto::updateOrCreate(
                    [
                        'idproducto' => $costo_producto['producto_id'],
                    ],
                    [
                        'idproducto' => $costo_producto['producto_id'],
                        'factor' => 1,
                        'costo' => $costo_producto['costo'],
                        'costoi' => $costo_producto['costoi'],
                        'preciou' => $costo_producto['preciou'],
                        'precio' => $costo_producto['precio'],
                        'precioi' => $costo_producto['precioi'],
                        'utili' => $costo_producto['utili'],
                        'rentabilidad' => $costo_producto['rentabilidad'],
                        'status' => 1,
                    ]
                );
            }



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

    public function cargarProductocostoId($id)
    {
        try {
            $productos = ProductoCosto::select(
                'idproducto',
                'factor',
                'costo',
                'costoi',
                'preciou',
                'precio',
                'precioi',
                'utili',
                'rentabilidad'
            )
                ->where('status', 1)
                ->where('idproducto', $id)
                ->first();


            return  response()->json(['productos' => $productos, 'total' => 1], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
