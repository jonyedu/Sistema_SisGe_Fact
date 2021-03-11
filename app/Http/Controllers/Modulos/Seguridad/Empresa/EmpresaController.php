<?php

namespace App\Http\Controllers\Modulos\Seguridad\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Seguridad\Empresa\Empresa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function cargarEmpresaTabla()
    {
        try {
            $empresas = Empresa::where('status', 1)
                ->orderBy('Empresa_Nombre', 'asc')
                ->get();
            return  response()->json(['empresas' => $empresas], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function guardarEmpresa(Request $request)
    {
        try {
            $user = Auth::user();
            Empresa::Create(
                [
                    'Empresa_Nombre' => $request->input('nombre'),
                    'Empresa_Ciudad' => $request->input('ciudad'),
                    'Empresa_Codigo_Postal' => $request->input('codigo_postal'),
                    'Empresa_Correo_Electronico' => $request->input('email'),
                    'Empresa_Fax' => $request->input('fax'),
                    'Empresa_Contribuyente_Especial' => $request->input('contribuyente_especial'),
                    'Empresa_Representante' => $request->input('representante'),
                    'Empresa_Notas' => $request->input('nota'),
                    'Empresa_Ruc' => $request->input('ruc'),
                    'Empresa_Telefonos' => $request->input('telefono'),
                    'Empresa_Ubicacion_Logo' => $request->input('ubicacion_logo'),
                    'Empresa_Ruta_Base' => ".",
                    'Empresa_Direccion' => $request->input('direccion'),
                    'Empresa_Tipo' => $request->input('tipo'),
                    'Empresa_Dsn_Bases' => ".",
                    'Empresa_Pais' => $request->input('pais'),
                    'Empresa_Moneda' => $request->input('moneda'),
                    'Empresa_Contador' => $request->input('contador'),
                    'Empresa_Contador_Ruc' => $request->input('contador_ruc'),
                    'Empresa_Actividad' => $request->input('actividad'),
                    'Empresa_Razon_Social' => $request->input('razon_social'),
                    'Empresa_Representante_Id' => ".",
                    'Empresa_Representante_Id_Tipo' => ".",
                    'Empresa_Inicio_Actividades' => $request->input('inicio_actividades'),
                    'Empresa_Constitucion' => $request->input('constitucion'),
                    'Empresa_Inscripcion' => $request->input('inscripcion'),
                    'Empresa_Actualizacion' => $request->input('actualizacion'),
                    'Empresa_Parroquia' => $request->input('parroquia'),
                    'Empresa_Provincia' => $request->input('provincia'),
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
    public function modificarEmpresa(Request $request)
    {
        try {
            $user = Auth::user();
            Empresa::where('status', 1)
                ->where('Empresa_Id', $request->input('empresa_id'))
                ->Update(
                    [
                        'Empresa_Nombre' => $request->input('nombre'),
                        'Empresa_Ciudad' => $request->input('ciudad'),
                        'Empresa_Codigo_Postal' => $request->input('codigo_postal'),
                        'Empresa_Correo_Electronico' => $request->input('email'),
                        'Empresa_Fax' => $request->input('fax'),
                        'Empresa_Contribuyente_Especial' => $request->input('contribuyente_especial'),
                        'Empresa_Representante' => $request->input('representante'),
                        'Empresa_Notas' => $request->input('nota'),
                        'Empresa_Ruc' => $request->input('ruc'),
                        'Empresa_Telefonos' => $request->input('telefono'),
                        'Empresa_Ubicacion_Logo' => $request->input('ubicacion_logo'),
                        'Empresa_Ruta_Base' => ".",
                        'Empresa_Direccion' => $request->input('direccion'),
                        'Empresa_Tipo' => $request->input('tipo'),
                        'Empresa_Dsn_Bases' => ".",
                        'Empresa_Pais' => $request->input('pais'),
                        'Empresa_Moneda' => $request->input('moneda'),
                        'Empresa_Contador' => $request->input('contador'),
                        'Empresa_Contador_Ruc' => $request->input('contador_ruc'),
                        'Empresa_Actividad' => $request->input('actividad'),
                        'Empresa_Razon_Social' => $request->input('razon_social'),
                        'Empresa_Representante_Id' => ".",
                        'Empresa_Representante_Id_Tipo' => ".",
                        'Empresa_Inicio_Actividades' => $request->input('inicio_actividades'),
                        'Empresa_Constitucion' => $request->input('constitucion'),
                        'Empresa_Inscripcion' => $request->input('inscripcion'),
                        'Empresa_Actualizacion' => $request->input('actualizacion'),
                        'Empresa_Parroquia' => $request->input('parroquia'),
                        'Empresa_Provincia' => $request->input('provincia'),
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
    public function eliminarEmpresa($id)
    {
        try {
            $user = Auth::user();
            Empresa::where('status', 1)
                ->where('Empresa_Id', $id)
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
