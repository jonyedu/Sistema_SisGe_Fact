<?php

namespace App\Http\Controllers\Modulos\Transaccion\Arqueo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Modulos\Transaccion\Arqueo\Arqueo;
use  App\Models\Modulos\Parametrizacion\Arqueo\ArqueoDes;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArqueoCaja extends Controller
{
    //
    public function cargarTiposArqueo(){
        try {
            $arqueo = ArqueoDes::select('id', 'descripcion','valor',)
             ->where('status',1)
            ->get();

           

            return  response()->json(['arqueo' => $arqueo, 'total' => 0], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function guardar_arque(Request $request){
        try {
            $user = Auth::user();
            $arqueo = $request->input('arqueo');
           // return  response()->json(['arqueo' => $arqueo, 'total' => 0], 200);

            foreach ($arqueo as $req){
                $data =  Arqueo::create(
                    [
                        //  'SecCirPro' => 0
                       
                        'id_arqueo' =>  $req['id'], 
                        'valor' =>  $req['valor'], 
                        'cantidad' =>  $req['cantidad'], 
                        'total' =>  $req['total'], 
                        'usu_created' => $user->codigo,
                        'usu_update' =>  $user->codigo,                    
                        'pcip' => $_SERVER["REMOTE_ADDR"], 
                        'status' => 1,
                    ]);
            }
            return  response()->json(['arqueo' => $data, 'total' => 0], 200);
           
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }

    }


    public function consultar_arqueo(Request $request){
        try {
            $arqueo =  Arqueo::select(
                DB::raw('sum(total) as total'),
                DB::raw('DATE(created_at) as date'),
            )->where('status',1)
            ->groupBy('date')
            ->get();


            // $frutas= Fruta::select(
            //     DB::raw('sum(precio) as sums'),
            //     DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            // )
            //     ->groupBy('months')
            //     ->get();
           

            return  response()->json(['arqueo' => $arqueo, 'total' => 0], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

}
