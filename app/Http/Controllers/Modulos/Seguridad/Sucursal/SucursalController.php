<?php

namespace App\Http\Controllers\Modulos\Seguridad\Sucursal;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Seguridad\Sucursal\Sucursal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SucursalController extends Controller
{
    public function cargarSucursalTabla()
    {
        try {
            $sucursales = Sucursal::where('status', 1)
                ->orderBy('Sucursal_Nombre', 'asc')
                ->get();
            return  response()->json(['sucursales' => $sucursales], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function cargarSucursalComboBox()
    {
        try {
            $sucursales = Sucursal::select('Sucursal_Id', 'Sucursal_Nombre')
                ->where('status', 1)
                ->orderBy('Sucursal_Nombre', 'asc')
                ->get();
            return  response()->json(['sucursales' => $sucursales], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarSucursal(Request $request)
    {
        try {
            $user = Auth::user();
            Sucursal::Create(
                [
                    'Empresa_Id' => $request->input('empresa_id'),
                    'Sucursal_Nombre' => $request->input('nombre'),
                    'Sucursal_Direccion' => $request->input('direccion'),
                    'Sucursal_Telefonos' => $request->input('telefono'),
                    'Sucursal_Administrador' => $request->input('administrador'),
                    'Sucursal_EMail' => $request->input('email'),
                    'Sucursal_Fax' => $request->input('fax'),
                    'Sucursal_Actividad' => $request->input('actividad'),
                    'Sucursal_Actividad_Inicio' => $request->input('actividad_inicio'),
                    'Sucursal_Matriz' => $request->input('matriz'),
                    'Sucursal_Provincia' => $request->input('provincia'),
                    'Sucursal_Canton' => $request->input('canton'),
                    'Sucursal_Parroquia' => $request->input('parroquia'),
                    'campo1' => ".",
                    'campo2' => ".",
                    'campo3' => ".",
                    'registro' => ".",
                    'usuario_ingreso' => $user->codigo,
                    'fecha_ingreso' => date("Y-m-d H:i:s"),
                    'usuario_modificacion' => $user->codigo,
                    'fecha_modificacion' => date("Y-m-d H:i:s"),
                    'name_pc' =>  $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                ]
            );

            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function modificarSucursal(Request $request)
    {
        try {
            $user = Auth::user();
            Sucursal::where('status', 1)
                ->where('codigo', $request->input('codigo'))
                ->Update(
                    [
                        'Empresa_Id' => $request->input('empresa_id'),
                        'Sucursal_Nombre' => $request->input('nombre'),
                        'Sucursal_Direccion' => $request->input('direccion'),
                        'Sucursal_Telefonos' => $request->input('telefono'),
                        'Sucursal_Administrador' => $request->input('administrador'),
                        'Sucursal_EMail' => $request->input('email'),
                        'Sucursal_Fax' => $request->input('fax'),
                        'Sucursal_Actividad' => $request->input('actividad'),
                        'Sucursal_Actividad_Inicio' => $request->input('actividad_inicio'),
                        'Sucursal_Matriz' => $request->input('matriz'),
                        'Sucursal_Provincia' => $request->input('provincia'),
                        'Sucursal_Canton' => $request->input('canton'),
                        'Sucursal_Parroquia' => $request->input('parroquia'),
                        'campo1' => ".",
                        'campo2' => ".",
                        'campo3' => ".",
                        'registro' => ".",
                        'usuario_modificacion' => $user->codigo,
                        'fecha_modificacion' => date("Y-m-d H:i:s"),
                        'name_pc' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 1,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function eliminarSucursal($id)
    {
        try {
            $user = Auth::user();
            Sucursal::where('status', 1)
                ->where('Sucursal_Id', $id)
                ->Update(
                    [
                        'usuario_modificacion' => $user->codigo,
                        'fecha_modificacion' => date("Y-m-d H:i:s"),
                        'name_pc' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
