<?php

namespace App\Http\Controllers\Modulos\Procesos\Facturacion\Ventas;

use App\Models\Modulos\Facturacion\s_par_fact_ventas_cabecera;
use App\Models\Modulos\Procesos\s_par_producto_inventario;
use App\Models\Modulos\Procesos\s_par_producto_costo;
use App\Models\Modulos\Procesos\s_par_producto;
//s_par_producto

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class fact_ventas_cabecera extends Controller
{
    //
     //
     public function cargarFacturasDelDia()
     {
         try {
             $factura = s_par_fact_ventas_cabecera::select('id', 'fecha', 'totalapagar', 'status')
                 ->where( 'status', 1)
                 ->get();
             return  response()->json(['factura' => $factura, 'total' => sizeOf($factura)], 200);
         } catch (Exception $e) {
             return response()->json(['mensaje' => $e->getMessage()], 500);
         }
     }
     //
     public function cargarProductosInventario($nombre)
     {
         try {

            $producto_inventario = s_par_producto_inventario::select('id_producto','Stock')
            ->with('ProductoInv:id,nombre')
            ->whereHas('ProductoInv', function ($query) use ($nombre){
                
                return $query->where("nombre", 'LIKE', '%'.$nombre.'%');
            })
            ->with("costoInv:idproducto,precio")
            ->get();

            // ->with("inventarioP:id,stock")  ->where('loan_officers', 'like', '%' . $officerId . '%')
            // ->with("costoP:id,precio")

 
             return  response()->json(['producto_inventario' => $producto_inventario, 'total' => sizeOf($producto_inventario)], 200);
         } catch (Exception $e) {
             return response()->json(['mensaje' => $e->getMessage()], 500);
         }
     }
}
