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


Route::group(['prefix' => '/modulos/parametrizacion', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de Facturacion Compra
    Route::namespace('Modulos\Parametrizacion\TipoDocumento')->prefix('tipo_documento')->group(function () {
        Route::get('cargar_tipo_documento_combo_box', 'TipoDocumentoController@cargarTipoDocumentoComboBox');
    });



});
