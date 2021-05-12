<?php

namespace App\Http\Controllers\Modulos\Reporte\FacturaVenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraCabecera;
use Exception;


use App\Models\Modulos\Transaccion\FacturaVenta\VentasCabecera;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasDetalle;


use App\Models\Modulos\Transaccion\Cotizacion\CotizacionCabecera;
use App\Models\Modulos\Transaccion\Cotizacion\CotizacionDetalle;


use App\Models\Modulos\Transaccion\FacturaVenta\VentasCredito;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCreditoDetalle;

class FacturaVentaReporteController extends Controller
{
    //
    public function cargarPdfFacturaVenta($factura_venta_cabecera_id, $id)
    {
        //Variables
        $nombreArchivo = null;
        $factura_venta = null;
        if ($id) {
            $factura_venta = VentasCabecera::select(
                'id',
                'id_cliente',
                'fecha',
                'viva',
                'subtotaliva1',
                'iva',
                'subtotaliva2',
                'totalapagar',
                'tipopago',
                'formapago',
                'cambio',
                'recibido',
                'status',
                'usu_created',
                'created_at'
            )
                ->where('id', $factura_venta_cabecera_id)
                ->where('status', 1)
                ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion')
                ->with('formapagoFactura:tipo_pago,descripcion')
                ->with('DetalleVenta.producto:id,codigo,nombre')

                ->with(
                    'usuario:codigo,perfil',
                    'usuario.opcionPorAplicacionPerfilOne:perfil,modulo',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion'
                )
                ->first();

            $nombre = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->NOMBRESCLIENTEPRO : "Sin nombre";
            $no_documento = $factura_venta->id;
            $nombreArchivo = getNamePdf($nombre, $no_documento);

            //return response()->json(['mensaje' => $factura_venta ], 200);

            $pdf = PDF::loadView('reports.Transaccion.FacturaVenta.FacturaVenta', [
                'factura_compra' => $factura_venta,
                'nombreArchivo' =>  $nombreArchivo,
                'factura' => "FACTURA",
            ]);
            return $pdf->stream($nombreArchivo);
        } else {
            $factura_venta = CotizacionCabecera::select(
                'id',
                'id_cliente',
                'fecha',
                'viva',
                'subtotaliva1',
                'iva',
                'subtotaliva2',
                'totalapagar',
                'tipopago',
                'formapago',
                'cambio',
                'recibido',
                'status',
                'usu_created',
                'created_at'
            )
                ->where('id', $factura_venta_cabecera_id)
                ->where('status', 1)
                ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion')
                ->with('formapagoFactura:tipo_pago,descripcion')
                ->with('DetalleVenta.producto:id,codigo,nombre')

                ->with(
                    'usuario:codigo,perfil',
                    'usuario.opcionPorAplicacionPerfilOne:perfil,modulo',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion'
                )
                ->first();

            $nombre = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->NOMBRESCLIENTEPRO : "Sin nombre";
            $no_documento = $factura_venta->id;
            $nombreArchivo = getNamePdf($nombre, $no_documento);



            $pdf = PDF::loadView('reports.Transaccion.FacturaVenta.FacturaVenta', [
                'factura_compra' => $factura_venta,
                'nombreArchivo' =>  $nombreArchivo,
                'factura' => "COTIZACIÓN",
            ]);
            return $pdf->stream($nombreArchivo);
        }

        ///aqui trataré de hacer el report para el credito :v



    }


    public function cargarPdfFacturaVentaCredito($factura_venta_cabecera_id)
    {
        //Variables
        $nombreArchivo = null;
        $factura_venta = null;


        ///aqui trataré de hacer el report para el credito :v



        $factura_venta = VentasCreditoDetalle::select(
            'id',
            'id_factura',
            'fecha',
            'interes',
            'total',
            'valor',
            'created_at',
            'updated_at'
        )
            ->where('id', $factura_venta_cabecera_id)
<<<<<<< HEAD
                  
 
                  ->with('cabeceraCredito:id,id_factura,total,id_tiempo_pago,id_cliente','cabeceraCredito.clienteFact:cliente_id,nombres,apellidos,cedula,direccion' )
                  ->with('usuario:codigo,perfil', 
                  'usuario.opcionPorAplicacionPerfilOne:perfil,modulo', 
                  'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                   'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion')
                  ->first();

                  $nombre = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->NOMBRESCLIENTEPRO : "Sin nombre";
                             $no_documento = $factura_venta->id;
                              $nombreArchivo = getNamePdf($nombre, $no_documento);

      return response()->json(['mensaje' => $factura_venta ], 200);
      
      $pdf = PDF::loadView('reports.Transaccion.FacturaCredito.FacturaCredito', [
          'factura_compra' => $factura_venta,
          'nombreArchivo' =>  $nombreArchivo,
          'factura' => "FACTURA - CREDITO",
      ]);
      return $pdf->stream($nombreArchivo);
      
        
        
=======


            ->with('cabeceraCredito:id,id_factura,total,id_tiempo_pago,id_cliente', 'cabeceraCredito.clienteFact:cliente_id,nombres,apellidos,cedula,direccion')
            ->with(
                'usuario:codigo,perfil',
                'usuario.opcionPorAplicacionPerfilOne:perfil,modulo',
                'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion'
            )
            ->first();

        $nombre = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->NOMBRESCLIENTEPRO : "Sin nombre";
        $no_documento = $factura_venta->id;
        $nombreArchivo = getNamePdf($nombre, $no_documento);

        //  return response()->json(['mensaje' => $factura_venta ], 200);

        $pdf = PDF::loadView('reports.Transaccion.FacturaCredito.FacturaCredito', [
            'factura_compra' => $factura_venta,
            'nombreArchivo' =>  $nombreArchivo,
            'factura' => "FACTURA - CREDITO",
        ]);
        return $pdf->stream($nombreArchivo);
>>>>>>> 98c235e37d89b597d0f047a6960ca9d06585db12
    }
}
