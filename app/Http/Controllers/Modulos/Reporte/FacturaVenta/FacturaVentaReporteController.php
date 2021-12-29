<?php

namespace App\Http\Controllers\Modulos\Reporte\FacturaVenta;

use App\Http\Controllers\Controller;
use App\Mail\Transaccion\FacturaVenta\EnvioFacturaVentaMail;
use App\Models\Modulos\Seguridad\Sucursal\Sucursal;
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
use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Reportes;

class FacturaVentaReporteController extends Controller
{
    //
    public function cargarPdfFacturaVenta($factura_venta_cabecera_id, $id, $enviar)
    {
        //Variables
        $nombreArchivo = null;
        $factura_venta = null;
        if ($id) {
            $factura_venta = VentasCabecera::select(
                'id',
                'id_cliente',
                'secuencia',
                'no_autorizacion',
                'fecha',
                'viva',
                'iva',
                'sub_total_12',
                'sub_total_0',
                'descuento',
                'sub_total',
                'iva_12',
                'total',
                'tipopago',
                'formapago',
                'caj',
                'cambio',
                'recibido',
                'observacion',
                'usu_created',
                'created_at'
            )
                ->where('id', $factura_venta_cabecera_id)
                ->where('status', 1)
                ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion,correo')
                ->with('formapagoFactura:tipo_pago,descripcion')
                ->with('DetalleVenta.producto:id,codigo,nombre')

                ->with(
                    'usuario:codigo,perfil',
                    'usuario.opcionPorAplicacionPerfilOne:perfil,modulo',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne.empresaOne:Empresa_Id,Empresa_Nombre,Empresa_Direccion,Empresa_Ubicacion_Logo,Empresa_Ruc,Empresa_Contribuyente_Especial,Empresa_Obligado_Contabilidad'
                )
                ->first();

            $nombre = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->NOMBRESCLIENTEPRO : "Sin nombre";
            $no_documento = $factura_venta->id;
            $nombreArchivo = getNamePdf($nombre, $no_documento);

            //return response()->json(['mensaje' => $factura_venta ], 200);

            $pdf = PDF::loadView('reports.Transaccion.FacturaVenta.FacturaVenta', [
                'factura_venta' => $factura_venta,
                'nombreArchivo' =>  $nombreArchivo,
                'factura' => "FACTURA",
            ]);
            //return $pdf->stream($nombreArchivo);





            //if enviar es "" solo mostrará el pdf
            if ($enviar == "false") {
                //return response()->json(['factura_venta' => $factura_venta], 200);
                return $pdf->stream($nombreArchivo);
            }
            //if enviar es "true" enviara el pdf al proveedor y mostrara
            else if ($enviar == "true") {
                //directorio a donde guardar
                $path = public_path('documentosEnviar/facturaVenta/');


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

                //Obtenemos el mail del cliente, para enviar la factura
                $correo_cliente = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->correo : null;

                //si no hay correo del cliente, se obtiene el correo del administrador de la sucursar
                if ($correo_cliente == null) {
                    $sucursal = Sucursal::where('status', 1)
                        ->orderBy('updated_at', 'desc')
                        ->first();

                    if ($sucursal != null) {
                        $correo_cliente = $sucursal->Sucursal_EMail;
                    } else {
                        $correo_cliente = 'sincorreo@hotmail.com';
                    }
                }

                $rutaImg = ($factura_venta != null ?
                    ($factura_venta->usuario != null ?
                        ($factura_venta->usuario->opcionPorAplicacionPerfilOne != null ?
                            ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne != null ?
                                ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne != null ?
                                    ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne != null ?
                                        ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Ubicacion_Logo) : '') : '') : '') : '') : '') : '');

                //Enviar la prescripcion vía Email al paciente
                Mail::to($correo_cliente)->send(new EnvioFacturaVentaMail($rutaSave, $factura_venta->clienteFact, $rutaImg));

                //return response()->json(['mensaje' =>$correo_cliente], 500);
                //Eliminar el archivo del servidor
                if (file_exists($rutaSave)) {
                    unlink($rutaSave);
                }
                // Fin Codigo para enviar la prescripcion al paciente por correo electrónico

                return $pdf->stream($nombreArchivo);
            }
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
                ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion,correo')
                ->with('formapagoFactura:tipo_pago,descripcion')
                ->with('DetalleVenta.producto:id,codigo,nombre')
                ->with(
                    'usuario:codigo,perfil',
                    'usuario.opcionPorAplicacionPerfilOne:perfil,modulo',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne:codigo,sucursal',
                    'usuario.opcionPorAplicacionPerfilOne.moduloOne.sucursalOne.empresaOne:Empresa_Id,Empresa_Nombre,Empresa_Direccion,Empresa_Ubicacion_Logo,Empresa_Ruc,Empresa_Contribuyente_Especial,Empresa_Obligado_Contabilidad'
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
            //return $pdf->stream($nombreArchivo);

            //if enviar es "" solo mostrará el pdf
            if ($enviar == "false") {
                return $pdf->stream($nombreArchivo);
            }
            //if enviar es "true" enviara el pdf al proveedor y mostrara
            else if ($enviar == "true") {
                //directorio a donde guardar
                $path = public_path('documentosEnviar/facturaVenta/');


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

                //Obtenemos el mail del cliente, para enviar la factura
                $correo_cliente = $factura_venta->clienteFact != null ? $factura_venta->clienteFact->correo : null;

                //si no hay correo del cliente, se obtiene el correo del administrador de la sucursar
                if ($correo_cliente == null) {
                    $sucursal = Sucursal::where('status', 1)
                        ->orderBy('updated_at', 'desc')
                        ->first();

                    if ($sucursal != null) {
                        $correo_cliente = $sucursal->Sucursal_EMail;
                    } else {
                        $correo_cliente = 'sincorreo@hotmail.com';
                    }
                }

                $rutaImg = ($factura_venta != null ?
                    ($factura_venta->usuario != null ?
                        ($factura_venta->usuario->opcionPorAplicacionPerfilOne != null ?
                            ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne != null ?
                                ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne != null ?
                                    ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne != null ?
                                        ($factura_venta->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Ubicacion_Logo) : '') : '') : '') : '') : '') : '');

                //Enviar la prescripcion vía Email al paciente
                Mail::to($correo_cliente)->send(new EnvioFacturaVentaMail($rutaSave, $factura_venta->clienteFact, $rutaImg));

                //return response()->json(['mensaje' =>$correo_cliente], 500);
                //Eliminar el archivo del servidor
                if (file_exists($rutaSave)) {
                    unlink($rutaSave);
                }
                // Fin Codigo para enviar la prescripcion al paciente por correo electrónico

                return $pdf->stream($nombreArchivo);
            }
        }

        ///aqui trataré de hacer el report para el credito :v



    }

    public function cargarFechaVenta($fechadesde,$fechahasta,$id)
    {
        try {
            $factura_venta = VentasCabecera::select(
                'id_cliente',
        'secuencia',
        'id',
       
        'no_autorizacion',
        'fecha',
        'viva',
        'iva',
        'sub_total_12',
        'sub_total_0',
        'descuento',
        'sub_total',
        'iva_12',
        'total',
        'tipopago',
        'formapago',
        'caj',
        'cambio',
                 
            )
            ->whereBetween('fecha',[ $fechadesde,$fechahasta])
                
                ->where('status', 1)
                ->with('clienteFact:cliente_id,nombres,apellidos,cedula,direccion,correo')
                ->with('formapagoFactura:tipo_pago,descripcion')
                ->with('DetalleVenta.producto:id,codigo,nombre')

                
                ->get();
            //  return  response()->json(['factura' => $factura_venta, 'total' =>  $factura_venta->sum('totalapagar')], 200);
                
                if ($id==1) {
                    # code...
                    
                $pdf = PDF::loadView('reports.Transaccion.ReporteVenta.reporte', [
                    'factura' => $factura_venta,
                    'total' => $factura_venta->sum('total'),
                    'nombre_reporte' =>  "REPORTE DE VENTAS",
                    
                ]);
                return $pdf->stream("REPORTE DE VENTAS");
                }else{

                    
                $nameExcel = 'REPORTE DE VENTAS' . $fechadesde . $fechahasta . '.xlsx';
                return Excel::download(new Reportes($factura_venta,
                $factura_venta->sum('total'),
                $fechadesde, 
                $fechahasta, 
                'REPORTE DE VENTAS'), $nameExcel);
                }




           // return  response()->json(['clientes' => $clientes, 'total' => sizeOf($clientes)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
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

        //return response()->json(['mensaje' => $factura_venta], 200);

        $pdf = PDF::loadView('reports.Transaccion.FacturaCredito.FacturaCredito', [
            'factura_compra' => $factura_venta,
            'nombreArchivo' =>  $nombreArchivo,
            'factura' => "FACTURA - CREDITO",
        ]);
        return $pdf->stream($nombreArchivo);
    }
}
