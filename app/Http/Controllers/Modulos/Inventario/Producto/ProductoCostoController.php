<?php

namespace App\Http\Controllers\Modulos\Inventario\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use App\Models\Modulos\Inventario\Producto\ProductoCosto;



class ProductoCostoController extends Controller
{
    //

    public function cargarProductocostoId($id)
    {
        try {
            $productos =ProductoCosto::select('idproducto','factor',
            'costo','costoi','preciou','precio','precioi','utili','rentabilidad')
            ->where('status', 1)
            ->where('idproducto', $id)
            ->firts();
            
            
            return  response()->json(['productos' => $productos, 'total' => sizeOf($productos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
