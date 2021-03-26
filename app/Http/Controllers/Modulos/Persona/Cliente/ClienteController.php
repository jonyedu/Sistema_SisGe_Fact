<?php

namespace App\Http\Controllers\Modulos\Persona\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Persona\Cliente\Cliente;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function cargarClienteComboBox()
    {
        try {
            $clientes = Cliente::select('cliente_id', 'nombres', 'status')
                ->where('estado', 1)
                ->get();
            return  response()->json(['clientes' => $clientes, 'total' => sizeOf($clientes)], 200);
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
            return  response()->json(['clientes' => $clientes, 'total' => sizeOf($clientes)], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }


    public function guardarModificarCliente(Request $request)
    {
        try {
            $user = Auth::user();
            Cliente::updateOrCreate(
                [
                    'cliente_id' => $request->input('cliente_id'),

                ],
                [
                    'nombres' => $request->input('nombre'),
                    'apellidos' => $request->input('apellido'),
                    'cedula' => $request->input('cedula'),
                    'telefono' => $request->input('telefono'),
                    'direccion' => $request->input('direccion'),
                    'correo' => $request->input('correo'),
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
    public function eliminarCliente($id)
    {
        try {
            $user = Auth::user();
            Cliente::where('status', 1)
                ->where('cliente_id', $id)
                ->Update(
                    [
                        'usu_update' => $user->codigo,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'pcip' =>  $_SERVER["REMOTE_ADDR"],
                        'status' => 0,
                    ]
                );
            return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
}
