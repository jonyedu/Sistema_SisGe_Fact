<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaVenta;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasCabecera;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
use App\Models\Modulos\Transaccion\Tarjetas\config_tipopago;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class VentasCabeceraController extends Controller
{
    public function cargarFacturasDelDia()
    {
        try {
            $factura = VentasCabecera::select('id', 'fecha', 'totalapagar', 'status')
                ->where('status', 1)
                ->get();
            return  response()->json(['factura' => $factura, 'total' => sizeOf($factura)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarProductosInventario($nombre)
    {
        try {

            $producto_inventario = ProductoInventario::select('id_producto', 'Stock')
                ->with('ProductoInv:id,nombre')
                ->whereHas('ProductoInv', function ($query) use ($nombre) {

                    return $query->where("nombre", 'LIKE', '%' . $nombre . '%');
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

    public function cargar_tipo(){
        try {
            //code...
            $tipo = config_tipopago::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);

        } catch (Exception $th) {
            //throw $th;
        }
    }


    public function guardarFacturaVenta()
    {
        try {
            //code...
        } catch (Exception $th) {
            //throw $th;
        }
    }
     
}
