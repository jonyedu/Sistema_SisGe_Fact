<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaVenta;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCabecera;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasDetalle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaVentaController extends Controller
{
    public function consultarNoFactura($no_factura)
    {
        try {
            $existe = VentasCabecera::select('secuencia')
                ->where('status', 1)
                ->where('secuencia', $no_factura)
                ->first();
            return  response()->json(['existe' => $existe], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarFacturaVenta($id)
    {
        try {
            $user = Auth::user();
            VentasCabecera::where('status', 1)
                ->where('id', $id)
                ->Update(
                    [
                        'usu_update' => $user->codigo,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'pcip' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            VentasDetalle::where('status', 1)
                ->where('id_facturav', $id)
                ->Update(
                    [
                        'usu_update' => $user->codigo,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'pcip' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );

            ProductoInventario::where('status', 1)
                ->where('id_factura', $id)
                ->Update(
                    [
                        'usu_update' => $user->codigo,
                        'updated_at' => date("Y-m-d H:i:s"),
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
