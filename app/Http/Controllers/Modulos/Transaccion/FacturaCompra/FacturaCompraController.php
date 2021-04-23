<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaCompra;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraCabecera;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraDetalle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaCompraController extends Controller
{
    public function consultarNoFactura($no_factura)
    {
        try {
            $existe = CompraCabecera::select('secuencia')
                ->where('status', 1)
                ->where('secuencia', $no_factura)
                ->first();
            return  response()->json(['existe' => $existe], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarModificarFacturaCompra(Request $request)
    {
        try {
            $user = Auth::user();
            $datos_factura_compra = $request->input('datos_factura_compra');
            $listar_producto = $request->input('listar_producto');
            $forma_pago = $request->input('forma_pago');
            $datos_productos_carritos = $listar_producto['productosCarrito']['_items'];
            //return  response()->json(['listar_producto' => $datos_productos_carritos]);
            $compra_detalle = CompraCabecera::updateOrCreate(
                [
                    'id' => $datos_factura_compra['factura_compra_cabecera_id'],
                    'status' => 1
                ],
                [
                    'id_documento' => $datos_factura_compra['tipo_documento_id'],
                    'secuencia' => $datos_factura_compra['no_documento'],
                    'id_proveedor' => $datos_factura_compra['proveedor_id'],
                    'fecha_compra' => $datos_factura_compra['fmt_registro'],
                    'totalapagar' => $listar_producto['total'],
                    'id_pago' => $forma_pago['forma_pago_id'],
                    'id_plazo' => 1,
                    'p_inicial' => $datos_factura_compra['tipo_documento_id'],
                    'observacion' => $listar_producto['descripcion'],
                    'usu_created' => $user->codigo,
                    'usu_update' => $user->codigo,
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                ]
            );

            //return  response()->json(['size' => sizeOf($datos_productos_carritos)]);

            foreach ($datos_productos_carritos as $producto) {
                CompraDetalle::updateOrCreate(
                    [
                        'id' => $producto['factura_compra_cuerpo_id'],
                    ],
                    [
                        'id_facturac' => $compra_detalle->id,
                        'id_prod' => $producto['id'],
                        'costo' => $producto['precio'],
                        'costimp' => $producto['precio'],
                        'cantidad' => $producto['cantidad'],
                        'total' => $producto['total'],
                        'fecha_caducidad' => date("Y-m-d"),
                        'pagado' => 0,
                    ]
                );
                ProductoInventario::updateOrCreate(
                    [
                        'id_factura' => $compra_detalle->id,
                        'id_producto' => $producto['id'],
                    ],
                    [
                        'id_factura' => $compra_detalle->id,
                        'id_producto' => $producto['id'],
                        'stock' => $producto['cantidad'],
                        'status' => 1,
                    ]
                );
            }



            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
