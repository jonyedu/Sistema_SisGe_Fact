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

class FacturaVentaReporteController extends Controller
{
    //
    public function cargarPdfFacturaVenta($factura_venta_cabecera_id,$id)
    {
        //Variables
        $nombreArchivo = null;
        $factura_venta = null;
        if ($id==true) {
            $factura_venta = VentasCabecera::select('id','id_cliente','fecha', 'viva', 'subtotaliva1',
        'iva', 'subtotaliva2','totalapagar','tipopago', 'formapago','cambio','recibido',
        'status','usu_created','created_at')
                    ->where('id', $factura_venta_cabecera_id)
                    ->where('status', 1)
                    ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion')
                    ->with('formapagoFactura:tipo_pago,descripcion')
                    ->with('DetalleVenta.producto:id,codigo,nombre')
                                       
                    ->with('usuario:codigo,perfil', 
                    'usuario.opcionPorAplicacionPerfilOne:perfil,modulo', 
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                     'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion')
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
              $factura_venta = CotizacionCabecera::select('id','id_cliente','fecha', 'viva', 'subtotaliva1',
        'iva', 'subtotaliva2','totalapagar','tipopago', 'formapago','cambio','recibido',
        'status','usu_created','created_at')
                    ->where('id', $factura_venta_cabecera_id)
                    ->where('status', 1)
                    ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion')
                    ->with('formapagoFactura:tipo_pago,descripcion')
                    ->with('DetalleVenta.producto:id,codigo,nombre')
                                       
                    ->with('usuario:codigo,perfil', 
                    'usuario.opcionPorAplicacionPerfilOne:perfil,modulo', 
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                     'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion')
                    ->first();

                    $nombre = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->NOMBRESCLIENTEPRO : "Sin nombre";
                               $no_documento = $factura_venta->id;
                                $nombreArchivo = getNamePdf($nombre, $no_documento);

        //return response()->json(['mensaje' => $factura_venta ], 200);
        
        $pdf = PDF::loadView('reports.Transaccion.FacturaVenta.FacturaVenta', [
            'factura_compra' => $factura_venta,
            'nombreArchivo' =>  $nombreArchivo,
            'factura' => "COTIZACIÓN",
        ]);
        return $pdf->stream($nombreArchivo);
        }
        
        
    }
}
