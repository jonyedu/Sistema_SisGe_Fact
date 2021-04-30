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
            $productos_ids = [];
            $datos_factura_compra = $request->input('datos_factura_compra');
            $listar_producto = $request->input('listar_producto');
            $forma_pago = $request->input('forma_pago');
            $datos_productos_carritos = $listar_producto['productosCarrito']['_items'];

            $compra_cabecera = CompraCabecera::updateOrCreate(
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



            //return  response()->json(['datos_productos_carritos' => $datos_productos_carritos]);

            //1)Factura que se guarda y despues se modifica quitando productos

            //Obtengo todos los productos de la factura
            $compras_detalles = CompraDetalle::where('id_facturac', $datos_factura_compra['factura_compra_cabecera_id'])
                ->where('status', 1)
                ->get();

            //agrego los producto_id a un nuevo arreglo
            foreach ($datos_productos_carritos as $producto) {
                array_push($productos_ids, $producto['producto_id']);
            }

            //Me devuelve todos los productos que hayan sido quitado en la vista.
            $productos_quitados = $compras_detalles->diff(CompraDetalle::whereIn('id_prod', $productos_ids)->get());
            //return  response()->json(['productos_quitados' => $productos_quitados]);
            //si existen productos quitados, entonces se cambia al estado a 0
            if ($productos_quitados->count() > 0) {
                foreach ($productos_quitados as $producto_quitado) {
                    CompraDetalle::where('status', 1)
                        ->where('id', $producto_quitado->id)
                        ->update(
                            [
                                'usu_update' => $user->codigo,
                                'pcip' => $_SERVER["REMOTE_ADDR"],
                                'status' => 0,
                            ]
                        );
                    //Obtengo el stock del producto de la factura de compra
                    $producto_inventario = ProductoInventario::where('status', 1)
                        ->where('id_factura', $compra_cabecera->id)
                        ->where('id_producto', $producto_quitado->id_prod)
                        ->first();

                    ProductoInventario::where('status', 1)
                        ->where('id_factura', $compra_cabecera->id)
                        ->where('id_producto', $producto_quitado->id_prod)
                        ->update(
                            [
                                'stock' => $producto_inventario->stock - $producto_quitado->cantidad,
                                'usu_update' => $user->codigo,
                                'pcip' => $_SERVER["REMOTE_ADDR"],
                                'status' => 1,
                            ]
                        );
                }
            }
            //1) Fin Factura que se guarda y despues se modifica quitando productos
            //return  response()->json(['productos_quitados' => $productos_quitados]);



            foreach ($datos_productos_carritos as $producto) {
                //2) Factura que se guarda y despues se modifica cambiando las cantidades
                $compra_detalle = CompraDetalle::where('id', $producto['factura_compra_cuerpo_id'])
                    ->where('status', 1)
                    ->first();
                //Valido si existe la factura
                if ($compra_detalle != null) {
                    //2.1 Si la cantidad no es igual a la que está guardado, entonces ha sido cambiado
                    if ($producto['cantidad'] != $compra_detalle->cantidad) {
                        //Resto para saber la diferencia que ha sigo cambiado
                        $diferencia_stock = 0;
                        //Obtengo el stock actual del producto
                        $producto_stock_actual = ProductoInventario::where('id', $producto['producto_inventario_id'])
                        ->where('status', 1)
                        ->first();
                        //2.1.1 La cantidad es mayor, entonces se suma
                        if ($producto['cantidad'] > $compra_detalle->cantidad) {
                            $diferencia_stock = $producto['cantidad'] - $compra_detalle->cantidad;
                            ProductoInventario::where('status', 1)
                                ->where('id_factura', $compra_cabecera->id)
                                ->where('id_producto', $producto['producto_id'])
                                ->update(
                                    [
                                        'stock' => $producto_stock_actual->stock + $diferencia_stock,
                                        'usu_update' => $user->codigo,
                                        'pcip' => $_SERVER["REMOTE_ADDR"],
                                        'status' => 1,
                                    ]
                                );
                        }
                        //2.1.2 La cantidad es menor, entonces se resta
                        if ($producto['cantidad'] < $compra_detalle->cantidad) {
                            //Resto para saber la diferencia que ha sigo cambiado
                            $diferencia_stock = $compra_detalle->cantidad - $producto['cantidad'];
                            ProductoInventario::where('status', 1)
                                ->where('id_factura', $compra_cabecera->id)
                                ->where('id_producto', $producto['producto_id'])
                                ->update(
                                    [
                                        'stock' => $producto_stock_actual->stock - $diferencia_stock,
                                        'usu_update' => $user->codigo,
                                        'pcip' => $_SERVER["REMOTE_ADDR"],
                                        'status' => 1,
                                    ]
                                );
                        }
                    }
                    //2) Fin Factura que se guarda y despues se modifica cambiando las cantidades
                } else {
                    ProductoInventario::updateOrCreate(
                        [
                            'id' => $producto['producto_inventario_id'],
                            'status' => 1,
                        ],
                        [
                            'id_factura' => $compra_cabecera->id,
                            'id_producto' => $producto['producto_id'],
                            'stock' => $producto['cantidad'],
                            'usu_created' => $user->codigo,
                            'usu_update' => $user->codigo,
                            'pcip' => $_SERVER["REMOTE_ADDR"],
                            'status' => 1,
                        ]
                    );
                }

                CompraDetalle::updateOrCreate(
                    [
                        'id' => $producto['factura_compra_cuerpo_id'],
                        'status' => 1,
                    ],
                    [
                        'id_facturac' => $compra_cabecera->id,
                        'id_prod' => $producto['producto_id'],
                        'costo' => $producto['precio'],
                        'costimp' => $producto['precio'],
                        'cantidad' => $producto['cantidad'],
                        'total' => $producto['total'],
                        'fecha_caducidad' => date("Y-m-d"),
                        'pagado' => 0,
                        'usu_created' => $user->codigo,
                        'usu_update' => $user->codigo,
                        'pcip' => $_SERVER["REMOTE_ADDR"],
                        'status' => 1,
                    ]
                );

                /* ProductoInventario::updateOrCreate(
                    [
                        'id' => $producto['producto_inventario_id'],
                        'status' => 1,
                    ],
                    [
                        'id_factura' => $compra_cabecera->id,
                        'id_producto' => $producto['producto_id'],
                        'stock' => $producto['cantidad'],
                        'usu_created' => $user->codigo,
                        'usu_update' => $user->codigo,
                        'pcip' => $_SERVER["REMOTE_ADDR"],
                        'status' => 1,
                    ]
                ); */
            }



            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
