<?php

namespace App\Http\Controllers\Modulos\Reporte\FacturaCompra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraCabecera;
use Exception;

class FacturaCompraReporteController extends Controller
{
    public function cargarPdfFacturaCompra($factura_compra_cabecera_id)
    {
        //Variables
        $nombreArchivo = null;
        $factura_compra = null;
        if ($factura_compra_cabecera_id > 0 && isset($factura_compra_cabecera_id)) {
            try {
                $factura_compra = CompraCabecera::select('id','secuencia','no_autorizacion','id_proveedor','fecha_compra','sub_total_0','sub_total_12','totalapagar','id_pago','usu_update')
                    ->where('id', $factura_compra_cabecera_id)
                    ->where('status', 1)
                    ->with('proveedor:id,nombre,apellido,ruc,cedula,razon_social,direccion')
                    ->with('tipoPago:tipo_pago,descripcion')
                    ->with('compraDetalle.producto:id,codigo,nombre')
                    ->with(['compraDetalle' => function ($i) {
                        $i->where('status', 1)->select('id','id_facturac','id_prod','costo','cantidad','total');
                    }])
                    ->with('usuario:codigo,perfil', 'usuario.opcionPorAplicacionPerfilOne:perfil,modulo', 'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal', 'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion', 'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne.empresaOne:Empresa_Id,Empresa_Nombre,Empresa_Direccion,Empresa_Ubicacion_Logo,Empresa_Ruc,Empresa_Contribuyente_Especial,Empresa_Obligado_Contabilidad')
                    ->first();
                if ($factura_compra != null) {
                    $nombre = $factura_compra->proveedor != null ? $factura_compra->proveedor->FULLNAME : "Sin nombre";
                    $no_documento = $factura_compra->secuencia;
                    $nombreArchivo = getNamePdf($nombre, $no_documento);
                    //return response()->json(['factura_compra' => $factura_compra]);
                    $pdf = PDF::loadView('reports.Transaccion.FacturaCompra.FacturaCompra', [
                        'factura_compra' => $factura_compra,
                        'nombreArchivo' => $nombreArchivo,
                    ]);

                    return $pdf->stream($nombreArchivo);
                } else {
                    $pdf = PDF::loadView('reports.Transaccion.FacturaCompra.FacturaCompra', [
                        'factura_compra' => $factura_compra
                    ]);

                    return $pdf->stream($nombreArchivo);
                }
            } catch (Exception $e) {
                return response()->json(['mensaje' => $e->getMessage()], 500);
            }
        } else {
            $pdf = PDF::loadView('reports.Transaccion.FacturaCompra.FacturaCompra', [
                'factura_compra' => $factura_compra
            ]);

            return $pdf->stream($nombreArchivo);
        }
    }
}
