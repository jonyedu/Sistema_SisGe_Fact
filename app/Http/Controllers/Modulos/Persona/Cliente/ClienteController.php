<?php

namespace App\Http\Controllers\Modulos\Persona\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Persona\Cliente\Cliente;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function cargarClienteCedula($cedula)
    {
        try {
            $clientes = Cliente::select('cliente_id', 'nombres', 'apellidos',  'cedula', 'telefono', 'direccion', 'correo' )
               // ->where('status', 1)
                ->where('cedula',$cedula)
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

    public function guardarCliente(Request $request)
    {
        try {
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'nombres' => 'required',
                'apellidos' => 'required',
                'cedula' => 'required|max:10',
                'telefono' => 'required',
                'direccion' => 'required',
                'email' => 'required|email',
                             // id_tarifaria
            ]);



 
            if ($validator->fails()) { 
               return response()->json(["errors" => $validator->getMessageBag()], 422);
            }

            $validacion = Cliente::where('cedula', $request->input('cedula'))
            ->get();

            if (sizeof($validacion)>=1) {
                # code...s
              
                return  response()->json(['lista' =>0], 200);
               // return response()->json(["errors" =>$validacion->getMessageBag()], 422);
            }

          $data = Cliente::create([
                    'nombres' => $request->input('nombres'),
                    'apellidos' => $request->input('apellidos'),
                    'cedula' => $request->input('cedula'),
                    'telefono' => $request->input('telefono'),
                    'direccion' => $request->input('direccion'),
                    'correo' => $request->input('email'),
                    'usu_created' => $user->codigo,
                    'usu_update' => $user->codigo,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'pcip' => $_SERVER["REMOTE_ADDR"],
                    'status' => 1,
                ]
            );
            return  response()->json(['lista' => $data->cliente_id], 200);
           // return  response()->json(['msj' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
