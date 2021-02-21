<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => '/dashboard/modulos/procesos', 'middleware' => ['auth:web'], 'verified'], function () {


    Route::namespace('Modulos\Procesos')->prefix('grupos')->group(function () {
        //grupos
        Route::get('grupos_fac', 'PargruposController@index');
    //     Route::get('cargar_paciente_cedula/{cedula}', 'PargruposController@ConsultarPacienteHospitalizados');
    //     Route::get('busqueda_historia/{idhospitalizacion}', 'AuditoriaController@ConsultarHistoriaClinica');
    //     Route::get('busqueda_documentos_por_tipo/{idDocumento}/{idPaciente}/{garantia}', 'AuditoriaController@visualizarDocumentosPorTipo');
    //   //  Route::get('busqueda_005H/{idhospitalizacion}', 'AuditoriaController@visualizarDocumentosPorTipo');
        // Route::get('cargar_cirujano', 'MedicoApiController@cargarCirujano');
        // Route::get('cargar_medico_all', 'MedicoApiController@cargarMedicoAll');
    });


});
