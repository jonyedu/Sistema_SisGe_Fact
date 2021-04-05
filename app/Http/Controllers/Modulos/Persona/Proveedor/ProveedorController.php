<?php

namespace App\Http\Controllers\Modulos\Persona\Proveedor;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Persona\Proveedor\Proveedor;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    public function cargarProveedorComboBox()
    {
        try {
            $proveedores = Proveedor::select('id', 'nombre', 'apellido', 'status')
                ->where('status', 1)
                ->get();
            return  response()->json(['proveedores' => $proveedores, 'total' => sizeOf($proveedores)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarProveedorAll()
    {
        try {
            $proveedores = Proveedor::select(
                'id',
                'nombre',
                'apellido',
                'cedula',
                'representante',
                'direccion',
                'telefono',
                'status'
            )
                ->where('status', 1)
                ->get();
            return  response()->json(['proveedores' => $proveedores, 'total' => sizeOf($proveedores)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function cargarProveedorCedula($cedula)
    {
        try {
            $proveedor = Proveedor::where('status', 1)
                ->where('cedula', $cedula)
                ->first();
            return  response()->json(['proveedor' => $proveedor], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    public function guardarModificarProveedor(Request $request)
    {
        //return  response()->json(['datos' => $request->input()]);
        try {
            $user = Auth::user();
            Proveedor::updateOrCreate(
                [
                    'id' => $request->input('Proveedor_id'),
                ],
                [
                    'nombre' => $request->input('nombre'),
                    'apellido' => $request->input('apellido'),
                    'cedula' => $request->input('cedula'),
                    'representante' => $request->input('representante'),
                    'direccion' => $request->input('direccion'),
                    'telefono' => $request->input('telefono'),
                    'usu_created' => $user->codigo,
                    'usu_update' => $user->codigo,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
