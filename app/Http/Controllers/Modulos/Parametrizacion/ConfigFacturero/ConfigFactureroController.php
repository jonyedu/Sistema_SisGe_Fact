<?php

namespace App\Http\Controllers\Modulos\Parametrizacion\ConfigFacturero;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Parametrizacion\ConfigFacturero\ConfigFacturero;
use Exception;
use Illuminate\Http\Request;

class ConfigFactureroController extends Controller
{
    public function getNoFactura()
    {
        try {
            $get_no_factura = ConfigFacturero::select('no_establecimiento', 'no_facturero', 'secuencia', 'no_autorizacion')
                ->where('status', 1)
                ->first();
            return  response()->json(['get_no_factura' => $get_no_factura], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
