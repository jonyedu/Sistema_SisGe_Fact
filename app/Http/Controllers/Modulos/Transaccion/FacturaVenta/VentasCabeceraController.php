<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaVenta;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasCabecera;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasDetalle;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
use App\Models\Modulos\Banco\TarjetaCredito\TarjetaCredito;
use App\Models\Modulos\Banco\Banco\Banco;
use App\Models\Modulos\Parametrizacion\FormaPago\FormaPago;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasTarjetas;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasCheque;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasCredito;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCreditoDetalle;


use App\Models\Modulos\Transaccion\Cotizacion\CotizacionCabecera;
use App\Models\Modulos\Transaccion\Cotizacion\CotizacionDetalle;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
//pdf
use Barryvdh\DomPDF\Facade as PDF;


use App\Http\Controllers\Modulos\Reporte\FacturaVenta\FacturaVentaReporteController;




use App\Http\Controllers\Controller;
use App\Models\Modulos\Banco\TipoPago\TipoPago;
use App\Models\Modulos\Parametrizacion\ConfigFacturero\ConfigFacturero;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasCabeceraController extends Controller
{
    public function cargarFacturasDelDia()
    {
        try {
            $factura = VentasCabecera::select('id', 'id_cliente', 'secuencia', 'fecha', 'total', 'status')
                ->with('cliente:cliente_id,nombres,apellidos')
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

            $producto_inventario = ProductoInventario::select(
                'id_producto',
                'Stock',
                'id',
                'id_factura',
            )
                ->with('ProductoInv:id,nombre,iva,imagen')
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


    public function cargarProductosInventarioPorTipos($id, $id_factura, $id_producto)
    {
        try {

            $producto_inventario = ProductoInventario::select('Stock')
                ->where('id', $id)
                ->where('id_factura', $id_factura)
                ->where('id_producto', $id_producto)
                ->first();

            return  response()->json(['producto_inventario' => $producto_inventario, 'total' => $producto_inventario], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargar_tipo()
    {
        try {
            //code...
            $tipo = TipoPago::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);
        } catch (Exception $th) {
            //throw $th;
        }
    }


    public function cargar_tarjetas()
    {
        try {
            //code...
            $tipo = TarjetaCredito::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);
        } catch (Exception $th) {
            //throw $th;
        }
    }

    public function cargar_bancos()
    {
        try {
            //code...
            $tipo = Banco::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);
        } catch (Exception $th) {
            //throw $th;
        }
    }

    public function guardarFacturaVenta(Request $request)
    {
        //return  response()->json(['tipo' => $request->input(), 'total' =>0 ], 500);
        try {
            //code...
            $user = Auth::user();
            $cotizacion = $request->input('cotizacion');
            $cotizacion_id = (int)$request->input('cotizacion');
            $datos_inventario = $request->input('inventario');
            $datos_cliente = $request->input('cliente');
            $datos_inventario_factura = $request->input('datos_inventario_factura');
            $datos_metodosp = $request->input('metodosp');

            if ($cotizacion == true) {

                $forma_pago =  $datos_metodosp["tipo_pagof"];
                $id_cliente = $datos_cliente["id"];
                $secuencia = $datos_cliente["no_documento"];
                $no_autorizacion = $datos_cliente["no_autorizacion"];
                $total = 0;
                $subtotal12 = 0;
                $subtotal0 = 0;
                $iva = 0;
                $viva = 0;
                $inventariop_p = [];

                // return  response()->json(['tipo' => $id_cliente, 'total' =>0 ], 200);

                for ($i = 0; $i < sizeof($datos_inventario); $i++) {
                    # code...
                    if ($datos_inventario[$i]["iva"] == 1) {
                        $viva += $datos_inventario[$i]["precio"] / 1.12;
                        $subtotal12 += $viva * $datos_inventario[$i]["cant"];
                        $iva = 12;
                    }
                    if ($datos_inventario[$i]["iva"] == 2) {
                        $subtotal0 += $datos_inventario[$i]["tot"];
                    }

                    $total += $datos_inventario[$i]["tot"];
                }

                // $total= 0;
                // $subtotal12 = 0;
                // $subtotal0 = 0;
                // $iva=0;
                // $viva=0;
                //  return  response()->json(['tipo' => $iva, 'total' =>0 ], 200);
                //ingreso la cabecera

                $data =  VentasCabecera::create(
                    [
                        //  'SecCirPro' => 0
                        'id_cliente' => $id_cliente,
                        'secuencia' => $secuencia,
                        'no_autorizacion' => $no_autorizacion,
                        'fecha' => date("Y-m-d H:i:s"),
                        'viva' => $iva,
                        'iva' => $viva,

                        'sub_total_12' => $datos_inventario_factura["sub_total_12"],
                        'sub_total_0' => $datos_inventario_factura["sub_total_0"],
                        'descuento' => $datos_inventario_factura["descuento"],
                        'sub_total' => $datos_inventario_factura["sub_total"],
                        'iva_12' => $datos_inventario_factura["iva_12"],
                        'total' => $datos_inventario_factura["total"],

                        'tipopago' => 0,
                        'formapago' => $forma_pago,
                        'caj' => 0,
                        'cambio' => 0,
                        'recibido' => 0,
                        'observacion' => $datos_inventario_factura["observacion"],
                        'status' => 1,
                        'usu_created' => $user->codigo,
                        'usu_update' => $user->codigo,
                        'pcip' => $_SERVER["REMOTE_ADDR"],
                        'status' => 1
                    ]

                );

                //Aqui es para actualizar el numero de secuencia
                $facturero = ConfigFacturero::where('no_autorizacion', $no_autorizacion)
                    ->where('status', 1)
                    ->first();

                ConfigFacturero::where('id', $facturero->id)
                    ->where('status', 1)
                    ->update([
                        'usu_update' => $user->codigo,
                        'secuencia' => $facturero->secuencia + 1,
                    ]);

                $id_cabecera = $data->id;
                // $total= 0;
                // $subtotal12 = 0;
                // $subtotal0 = 0;
                // $iva=0;
                // $viva=0;
                //VentasDetalle
                for ($i = 0; $i < sizeof($datos_inventario); $i++) {
                    # code...


                    VentasDetalle::create(
                        [
                            //  'SecCirPro' => 0
                            'id_facturav' => $id_cabecera,
                            'id_producto' => $datos_inventario[$i]["id"],
                            'iva' => $datos_inventario[$i]["iva"],
                            'factor' => 0,
                            'valor' => $datos_inventario[$i]["precio"],
                            'cantidad' => $datos_inventario[$i]["cant"],
                            'total' => $datos_inventario[$i]["tot"],
                            'usu_created' => $user->codigo,
                            'usu_update' => $user->codigo,
                            'pcip' => $_SERVER["REMOTE_ADDR"],
                            'status' => 1,
                        ]

                    );

                    //aqui voy a actualizar :v

                    $producto_inventario = ProductoInventario::select('Stock')
                        ->where('id', $datos_inventario[$i]["idfac"])
                        ->where('id_factura', $datos_inventario[$i]["idfacCompra"])
                        ->where('id_producto', $datos_inventario[$i]["id"])
                        ->first();



                    $inventario_final = $producto_inventario->Stock - $datos_inventario[$i]["cant"];
                    // return  response()->json(['tipo' =>  $inventario_final, 'total' =>0 ], 200);
                    ProductoInventario::where('id', $datos_inventario[$i]["idfac"])
                        ->where('id_factura', $datos_inventario[$i]["idfacCompra"])
                        ->where('id_producto', $datos_inventario[$i]["id"])
                        ->update(
                            [
                                'Stock' => $inventario_final

                            ]
                        );
                }


                if ($forma_pago == 2) {
                    VentasTarjetas::create(
                        [
                            //  'SecCirPro' => 0
                            'factura' => $id_cabecera,
                            'numero' => 0,
                            'numero_tarjeta' =>  $datos_metodosp["numero_tarjeta"],
                            'caduca' =>  $datos_metodosp["caduca"],
                            'cliente' => $datos_metodosp["cliente"],
                            'registro' => date("Y-m-d H:i:s"),
                            'usuario_ingreso' =>  $user->codigo,
                            'fecha_ingreso' => date("Y-m-d H:i:s"), 'status' => 1

                        ]

                    );
                }

                if ($forma_pago == 3) {
                    VentasCheque::create(
                        [
                            //  'SecCirPro' => 0
                            'id_facturav' => $id_cabecera,
                            'fecha_emision' => $datos_metodosp["fecha_emision"],
                            'cantidad' =>  $datos_metodosp["cantidad_pagarf"],
                            'nombre' =>  $datos_metodosp["nombref"],
                            'banco' => $datos_metodosp["banco"],
                            'beneficiario' => $datos_metodosp["beneficiario"],
                            'numero_cuenta' => $datos_metodosp["numero_cuenta"],
                            'usu_created' =>  $user->codigo,
                            'usu_update' =>  $user->codigo,
                            'created_at' =>  date("Y-m-d H:i:s"),
                            'updated_at' =>  date("Y-m-d H:i:s"),
                            'pcip' => $_SERVER["REMOTE_ADDR"],
                            'status' => 1
                        ]

                    );
                }


                if ($forma_pago == 4) {
                    // return  response()->json(['tipo' =>  $id_cliente["id"], 'total' =>0 ], 200);
                    $data_credito =   VentasCredito::create([
                        'id_factura' => $id_cabecera,
                        'total' => $total,
                        'id_tiempo_pago' => $datos_metodosp["formacreditof"],
                        'id_cliente' => $id_cliente,
                        'usu_created' =>  $user->codigo,
                        'usu_update' =>  $user->codigo,
                        'created_at' =>  date("Y-m-d H:i:s"),
                        'updated_at' =>  date("Y-m-d H:i:s"),
                        'pcip' => $_SERVER["REMOTE_ADDR"],
                        'status' => 1

                    ]);
                    //return  response()->json(['tipo' =>  $datos_metodosp["creditofacturaventa"], 'total' =>0 ], 200);

                    for ($i = 0; $i < sizeof($datos_metodosp["creditofacturaventa"]); $i++) {
                        # code...

                        VentasCreditoDetalle::create([
                            'id_factura' => $id_cabecera,
                            'fecha' =>  date('Y-m-d', strtotime($datos_metodosp["creditofacturaventa"][$i]["fecha"])),
                            'interes' => $datos_metodosp["creditofacturaventa"][$i]["interes"],
                            'total' =>  $datos_metodosp["creditofacturaventa"][$i]["total"],
                            'valor' => $datos_metodosp["creditofacturaventa"][$i]["valor"],
                            'usu_created' =>  $user->codigo,
                            'usu_update' => $user->codigo,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' =>  date("Y-m-d H:i:s"),
                            'pcip' => $_SERVER["REMOTE_ADDR"],
                            'status' => 1

                        ]);
                    }
                }
            } else {

                $forma_pago =  $datos_metodosp["tipo_pagof"];
                $id_cliente = $datos_cliente["id"];
                $total = 0;
                $subtotal12 = 0;
                $subtotal0 = 0;
                $iva = 0;
                $viva = 0;
                $inventariop_p = [];

                for ($i = 0; $i < sizeof($datos_inventario); $i++) {
                    # code...
                    if ($datos_inventario[$i]["iva"] == 1) {
                        $viva += $datos_inventario[$i]["precio"] / 1.12;
                        $subtotal12 += $viva * $datos_inventario[$i]["cant"];
                        $iva = 12;
                    }
                    if ($datos_inventario[$i]["iva"] == 2) {
                        $subtotal0 += $datos_inventario[$i]["tot"];
                    }

                    $total += $datos_inventario[$i]["tot"];
                }

                $data =  CotizacionCabecera::create(
                    [
                        //  'SecCirPro' => 0
                        'id_cliente' => $id_cliente,
                        'fecha' => date("Y-m-d H:i:s"),
                        'viva' => $iva,
                        'subtotaliva1' => $subtotal12,
                        'iva' => $viva,
                        'subtotaliva2' => $subtotal0,
                        'totalapagar' => $total,
                        'tipopago' => 0,
                        'formapago' => $forma_pago,
                        'caj' => 0,
                        'cambio' => 0,
                        'recibido' => 0,
                        'status' => 1,
                        'usu_created' => $user->codigo,
                        'usu_update' => $user->codigo,
                        'pcip' => $_SERVER["REMOTE_ADDR"],
                        'status' => 1
                    ]

                );

                $id_cabecera = $data->id;
                for ($i = 0; $i < sizeof($datos_inventario); $i++) {
                    # code...
                    CotizacionDetalle::create(
                        [
                            //  'SecCirPro' => 0
                            'id_facturac' => $id_cabecera,
                            'id_producto' => $datos_inventario[$i]["id"],
                            'iva' => $datos_inventario[$i]["iva"],
                            'factor' => 0,
                            'valor' => $datos_inventario[$i]["precio"],
                            'cantidad' => $datos_inventario[$i]["cant"],
                            'total' => $datos_inventario[$i]["tot"],
                            'usu_created' => $user->codigo,
                            'usu_update' => $user->codigo,
                            'created_at' =>  date("Y-m-d H:i:s"),
                            'updated_at' =>  date("Y-m-d H:i:s"),
                            'pcip' => $_SERVER["REMOTE_ADDR"],
                            'status' => 1

                        ]

                    );
                }
            }



            //$result = (new FacturaVentaReporteController)->cargarPdfFacturaVenta($data->id, $cotizacion_id);


            return  response()->json(['tipo' => $data->id, 'total' => 0], 200);
        } catch (Exception $th) {
            //throw $th;
            return  response()->json(['errors' =>  $th->getMessage()], 500);
        }
    }

    public function cargar_forma_pago()
    {
        try {
            //code...
            $tipo = FormaPago::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);
        } catch (Exception $th) {
            //throw $th;
        }
    }
    public function cargar_forma_pago_id($id)
    {
        try {
            //code...
            $tipo = FormaPago::where('id', $id)->get();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);
        } catch (Exception $th) {
            //throw $th;
        }
    }
}
