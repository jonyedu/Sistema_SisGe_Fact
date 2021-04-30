<?php

namespace App\Http\Controllers\Modulos\Transaccion\FacturaVenta;

use App\Models\Modulos\Transaccion\FacturaVenta\VentasCabecera;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
use App\Models\Modulos\Banco\TarjetaCredito\TarjetaCredito;
use App\Models\Modulos\Banco\Banco\Banco;
use App\Models\Modulos\Parametrizacion\FormaPago\FormaPago;





use App\Http\Controllers\Controller;
use App\Models\Modulos\Banco\TipoPago\TipoPago;
use Exception;
use Illuminate\Http\Request;

class VentasCabeceraController extends Controller
{
    public function cargarFacturasDelDia()
    {
        try {
            $factura = VentasCabecera::select('id', 'fecha', 'totalapagar', 'status')
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

            $producto_inventario = ProductoInventario::select('id_producto', 'Stock')
                ->with('ProductoInv:id,nombre,imagen,iva')
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

    public function cargar_tipo(){
        try {
            //code...
            $tipo = TipoPago::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);

        } catch (Exception $th) {
            //throw $th;
        }
    }


    public function cargar_tarjetas(){
        try {
            //code...
            $tipo = TarjetaCredito::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);

        } catch (Exception $th) {
            //throw $th;
        }
    }

    public function cargar_bancos(){
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
        try {
            //code...
            $datos_inventario = $request->input('inventario');
            $datos_cliente = $request->input('cliente');
            $datos_metodosp = $request->input('metodosp');
            

            $total= 0;
            $subtotal12 = 0;
            $subtotal0 = 0;

            // for ($i=0; $i < sizeof($datos_inventario) ; $i++) { 
            //     # code...
            //     if 
            // }

             


            return  response()->json(['tipo' => $datos_inventario, 'total' =>0 ], 200);

        } catch (Exception $th) {
            //throw $th;
        }
    }

    public function cargar_forma_pago(){
        try {
            //code...
            $tipo = FormaPago::All();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);

        } catch (Exception $th) {
            //throw $th;
        }
    }
    public function cargar_forma_pago_id($id){
        try {
            //code...
            $tipo = FormaPago::where('id',$id)->get();
            return  response()->json(['tipo' => $tipo, 'total' => sizeOf($tipo)], 200);

        } catch (Exception $th) {
            //throw $th;
        }
    }
     
}
