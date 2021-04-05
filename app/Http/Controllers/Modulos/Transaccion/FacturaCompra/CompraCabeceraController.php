<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaCompra;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraCabecera;
use Exception;
use Illuminate\Http\Request;

class CompraCabeceraController extends Controller
{
    public function cargarCompraCabeceraTabla()
    {
        try {
            $comprasCabecera = CompraCabecera::where('status', 1)
                ->with('proveedor:id,nombre', 'tipoPago:tipo_pago,descripcion')
                ->get();
            return  response()->json(['comprasCabecera' => $comprasCabecera, 'total' => sizeOf($comprasCabecera)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
