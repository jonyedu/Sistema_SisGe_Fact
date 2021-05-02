<?php

namespace App\Http\Controllers\Modulos\Inventario\Producto;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Inventario\Producto\Producto;
use Exception;
use Illuminate\Http\Request;

class ProductoApiController extends Controller
{
    public function cargarProductoAll()
    {
        try {
            $productos = Producto::select('id','codigo', 'nombre', 'nombrecorto', 'pvc', 'imagen')
                ->where('status', 1)
                ->with('productoInventarioMany')
                ->get();
            return  response()->json(['productos' => $productos, 'total' => sizeOf($productos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
