<?php

namespace App\Http\Controllers\Modulos\Transaccion\Arqueo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use  App\Models\Modulos\Parametrizacion\Arqueo\ArqueoDes;
use Exception;
 
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

}
