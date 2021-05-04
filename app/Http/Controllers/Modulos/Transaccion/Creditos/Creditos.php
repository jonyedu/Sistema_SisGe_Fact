<?php

namespace App\Http\Controllers\Modulos\Transaccion\Creditos;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasCredito;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCreditoDetalle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
 
use Illuminate\Support\Facades\Auth;


class Creditos extends Controller
{
    //

    public function cargarClientes(){
        try {
            $cliente = VentasCredito::select('id', 
            'id_factura', 
            'total', 
            'id_tiempo_pago', 
            'id_cliente','status')
            ->with('clienteFact:cliente_id,nombres,apellidos,cedula')
            ->with('tiempoCredito:id,descripcion')
            ->where('status',1)
            ->get();

           

            return  response()->json(['cliente' => $cliente, 'total' => sizeOf($cliente)], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function cargarClientesDetalles($id_factura){
        try {
            $cliente = VentasCreditoDetalle::select( 'id','id_factura', 
            'fecha', 
            'interes', 
            'total', 
            'valor',
            'status')            
            ->where('id_factura',$id_factura)
            ->get();

           

            return  response()->json(['cliente' => $cliente, 'total' => sizeOf($cliente)], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function updatecuota(Request $request){
        try {
            return  response()->json(['cliente' =>$request->input('status'), 'total' => 0], 200);
            $user = Auth::user();

            if ($request->input('status')==1) {
                //return  response()->json(['cliente' =>$request->input('status'), 'total' => 0], 200);
                $actualizar =  VentasCreditoDetalle::where('id_factura',$request->input('id_factura'))
                ->where('id',$request->input('id'))
               ->update(
                     [
                         'status' => 2,
                         'usu_update'=>$user->codigo,
                         'updated_at'=> date("Y-m-d H:i:s"),
                       
                     ]
                 );
            } else {
                return  response()->json(["errors" => "Factura Cancelada"], 422);
            }
            


         

           

            return  response()->json(['cliente' => $actualizar, 'total' => 0], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

}
