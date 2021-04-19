<?php

namespace App\Http\Controllers\Modulos\Parametrizacion\TipoDocumento;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Parametrizacion\TipoDocumento\TipoDocumento;
use Exception;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function cargarTipoDocumentoComboBox()
    {
        try {
            $tiposDocumentos = TipoDocumento::select('id', 'descripcion', 'status')
                ->where('status', 1)
                ->get();
            return  response()->json(['tiposDocumentos' => $tiposDocumentos, 'total' => sizeOf($tiposDocumentos)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
