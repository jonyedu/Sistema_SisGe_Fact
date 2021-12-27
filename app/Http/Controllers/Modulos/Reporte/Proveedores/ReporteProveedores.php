<?php

namespace App\Http\Controllers\Modulos\Reporte\Proveedores;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulos\Persona\Cliente\Cliente;


use App\Models\Modulos\Persona\Proveedor\Proveedor;

class ReporteProveedores extends Controller
{
    public function ReporteProveedor()
    {
        try {
            $proveedores = Proveedor::select(
                'id',
                'nombre',
                'apellido',
                'cedula',
                'ruc',
                'razon_social',
                'direccion',
                'telefono',
                'correo',
                'status'
            )
                ->where('status', 1)
                ->get();
            
                $pdf = PDF::loadView('reports.Transaccion.Persona.Proveedor', [
                    'proveedores' => $proveedores,
                    'nombre_reporte' =>  "Proveedores",
                    
                ]);
                return $pdf->stream("Proveedor");
            return  response()->json(['proveedores' => $proveedores, 'total' => sizeOf($proveedores)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    public function cargarClienteAll()
    {
        try {
            $clientes = Cliente::select('cliente_id', 'nombres', 'apellidos',  'cedula', 'telefono', 'direccion', 'correo', 'status')
                ->where('status', 1)
                ->get();
              // return  response()->json(['clientes' => $clientes, 'total' => sizeOf($clientes)], 200);
                $pdf = PDF::loadView('reports.Transaccion.cliente.Cliente', [
                    'proveedores' => $clientes,
                    'nombre_reporte' =>  "Clientes",
                    
                ]);
                return $pdf->stream("Clientes");
           // return  response()->json(['clientes' => $clientes, 'total' => sizeOf($clientes)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    
}
