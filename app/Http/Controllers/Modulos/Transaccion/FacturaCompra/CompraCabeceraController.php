<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaCompra;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Inventario\Producto\Producto;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
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

    public function cargarProductoPorProveedor($proveedor_id)
    {
        try {

            /* $producto_inventario = Producto::where("laboratorio_id", $proveedor_id)
            ->where('status', 1)
            ->get(); */
            $producto_inventario = ProductoInventario::select('id_producto', 'Stock')
                ->with('ProductoInv:id,nombre,laboratorio_id,iva,imagen')
                ->whereHas('ProductoInv', function ($query) use ($proveedor_id) {

                    return $query->where("laboratorio_id", $proveedor_id);
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
