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


Route::group(['prefix' => 'modulos/parametrizacion', 'middleware' => ['auth:web'], 'verified'], function () {

    Route::namespace('Modulos\Parametrizacion\TipoDocumento')->prefix('tipo_documento')->group(function () {
        Route::get('cargar_tipo_documento_combo_box', 'TipoDocumentoController@cargarTipoDocumentoComboBox');
    });

    Route::namespace('Modulos\Parametrizacion\ConfigFacturero')->prefix('config_facturero')->group(function () {
        Route::get('get_no_factura', 'ConfigFactureroController@getNoFactura');
    });



});

$prefijo = config('global.router_prefix');
Route::get($prefijo . '/{any}', 'AppController@index')->where('any', '.*');
Route::get($prefijo, 'AppController@index')->where('any', '.*')->name('main');