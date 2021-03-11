<?php

namespace App\Http\Controllers\Modulos\Procesos\Facturacion\Ventas;

use App\Models\Modulos\Facturacion\s_par_fact_ventas_cabecera;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class fact_ventas_cabecera extends Controller
{
    //
     //
     public function cargarFacturasDelDia()
     {
         try {
             $factura = s_par_fact_ventas_cabecera::select('id', 'fecha', 'totalapagar','estado')
                 ->where('estado', 1)
                 ->get();
             return  response()->json(['factura' => $factura, 'total' => sizeOf($factura)], 200);
         } catch (Exception $e) {
             return response()->json(['mensaje' => $e->getMessage()], 500);
         }
     }
}
