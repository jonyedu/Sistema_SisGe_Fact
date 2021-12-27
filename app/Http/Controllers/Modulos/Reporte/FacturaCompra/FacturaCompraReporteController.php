<?php

namespace App\Http\Controllers\Modulos\Reporte\FacturaCompra;

use App\Http\Controllers\Controller;
use App\Mail\Transaccion\FacturaCompra\EnvioFacturaCompraMail;
use App\Models\Modulos\Seguridad\Sucursal\Sucursal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraCabecera;
use Exception;
use Illuminate\Support\Facades\Mail;

class FacturaCompraReporteController extends Controller
{
    public function cargarPdfFacturaCompra($factura_compra_cabecera_id, $enviar)
    {
        //Variables
        $nombreArchivo = null;
        $factura_compra = null;
        if ($factura_compra_cabecera_id > 0 && isset($factura_compra_cabecera_id)) {
            try {
                $factura_compra = CompraCabecera::select('id', 'secuencia', 'no_autorizacion', 'id_proveedor', 'fecha_compra', 'sub_total_0', 'sub_total_12', 'totalapagar', 'id_pago', 'usu_update')
                    ->where('id', $factura_compra_cabecera_id)
                    ->where('status', 1)
                    ->with('proveedor:id,nombre,apellido,ruc,cedula,razon_social,direccion,correo')
                    ->with('tipoPago:tipo_pago,descripcion')
                    ->with('compraDetalle.producto:id,codigo,nombre')
                    ->with(['compraDetalle' => function ($i) {
                        $i->where('status', 1)->select('id', 'id_facturac', 'id_prod', 'costo', 'cantidad', 'total');
                    }])
                    ->with(
                        'usuario:codigo,perfil',
                        'usuario.opcionPorAplicacionPerfilOne:perfil,modulo',
                        'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                        'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne:Sucursal_Id,Empresa_Id,Sucursal_Direccion',
                        'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne.empresaOne:Empresa_Id,Empresa_Nombre,Empresa_Direccion,Empresa_Ubicacion_Logo,Empresa_Ruc,Empresa_Contribuyente_Especial,Empresa_Obligado_Contabilidad'
                    )
                    ->first();
                if ($factura_compra != null) {
                    //Codigo para enviar la prescripcion al paciente por correo electrónico
                    $correo_proveedor = null;
                    $nombre = $factura_compra->proveedor != null ? $factura_compra->proveedor->FULLNAME : "Sin nombre";
                    $no_documento = $factura_compra->secuencia;
                    $nombreArchivo = getNamePdf($nombre, $no_documento);
                    //return response()->json(['factura_compra' => $factura_compra]);
                    $pdf = PDF::loadView('reports.Transaccion.FacturaCompra.FacturaCompra', [
                        'factura_compra' => $factura_compra,
                        'nombreArchivo' => $nombreArchivo,
                    ]);

                    //if enviar es "" solo mostrará el pdf
                    if ($enviar == "false") {
                        return $pdf->stream($nombreArchivo);
                    }
                    //if enviar es "true" enviara el pdf al proveedor y mostrara
                    else if ($enviar == "true") {
                        //directorio a donde guardar
                        $path = public_path('documentosEnviar/facturaCompra/');


                        //verificamos que el directorio , existe en el servidor
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        //Ruta para guardar en el servidor
                        $destinationPath = $path;
                        //Concatenar la ruta y el nombre del archivo
                        $rutaSave = $destinationPath . $nombreArchivo;
                        //return response()->json(['rutaSave' => $rutaSave], 500);

                        //Guardalo en una variable
                        $pdf->save($rutaSave);
                        //Aqui es donde guarda en el servidor
                        //file_put_contents($rutaSave, $output);

                        //Obtenemos el mail del proveedor, para enviar la factura
                        $correo_proveedor = $factura_compra->proveedor != null ? $factura_compra->proveedor->correo : null;

                        //si no hay correo del proveedor, se obtiene el correo del administrador de la sucursar
                        if ($correo_proveedor == null) {
                            $sucursal = Sucursal::where('status', 1)
                                ->orderBy('updated_at', 'desc')
                                ->first();

                            if ($sucursal != null) {
                                $correo_proveedor = $sucursal->Sucursal_EMail;
                            } else {
                                $correo_proveedor = 'sincorreo@hotmail.com';
                            }
                        }

                        $rutaImg = ($factura_compra != null ?
                            ($factura_compra->usuario != null ?
                                ($factura_compra->usuario->opcionPorAplicacionPerfilOne != null ?
                                    ($factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne != null ?
                                        ($factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne != null ?
                                            ($factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne != null ?
                                                ($factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Ubicacion_Logo) : '') : '') : '') : '') : '') : '');

                        //Enviar la prescripcion vía Email al paciente
                        $email = Mail::to($correo_proveedor)->send(new EnvioFacturaCompraMail($rutaSave, $factura_compra->proveedor, $rutaImg));
                        
                        return response()->json(['email' =>$email], 500);
                        //Eliminar el archivo del servidor
                        if (file_exists($rutaSave)) {
                            unlink($rutaSave);
                        }
                        // Fin Codigo para enviar la prescripcion al paciente por correo electrónico

                        return $pdf->stream($nombreArchivo);
                    }
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

    public function cargarFechaCompra($fechadesde,$fechahasta)
    {
        try {
            $factura_compra = CompraCabecera::select( 'id',
            'id_documento',
            'secuencia',
 
            'id_proveedor',
            'fecha_compra',
             'totalapagar',
            'id_pago',
            'p_inicial')
            ->whereBetween('fecha_compra',[ $fechadesde,$fechahasta])
                    ->where('status', 1)
                   
                    ->with('proveedor:id,nombre,apellido,ruc,cedula,razon_social,direccion,correo')
                    ->with('tipoPago:tipo_pago,descripcion')
                    ->with('compraDetalle.producto:id,codigo,nombre')
                    ->with(['compraDetalle' => function ($i) {
                        $i->where('status', 1)->select('id', 'id_facturac', 'id_prod', 'costo', 'cantidad', 'total');
                    }])
                    
                    ->get();
              //return  response()->json(['factura' => $factura_compra, 'total' =>  $factura_compra->sum('totalapagar')], 200);


                $pdf = PDF::loadView('reports.Transaccion.ReporteCompra.reporte', [
                    'factura' => $factura_compra,
                    'total' => $factura_compra->sum('totalapagar'),
                    'nombre_reporte' =>  "REPORTE DE COMPRAS",
                    
                ]);
                return $pdf->stream("REPORTE DE COMPRAS");
           // return  response()->json(['clientes' => $clientes, 'total' => sizeOf($clientes)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
