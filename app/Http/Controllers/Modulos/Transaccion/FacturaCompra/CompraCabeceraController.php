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
                ->with('proveedor', 'tipoPago:tipo_pago,descripcion')
                ->with('compraDetalle.producto','compraDetalle.productoInventario')
                ->get();
            return  response()->json(['comprasCabecera' => $comprasCabecera, 'total' => sizeOf($comprasCabecera)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarProductoPorProveedor($proveedor_id)
    {
        try {
            $producto_inventario = Producto::select('id','nombre', 'pvc', 'iva','imagen')
                ->with('productoCosto:idproducto,costo,costoi,precio', 'productoInventario:id,id_factura,id_producto,stock')
                ->where("laboratorio_id", $proveedor_id)
                ->where('status', 1)
                ->get();


            return  response()->json(['producto_inventario' => $producto_inventario, 'total' => sizeOf($producto_inventario)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
