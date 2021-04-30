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


Route::group(['prefix' => '/modulos/reporte', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de
    Route::namespace('Modulos\Reporte\FacturaCompra')->prefix('factura_compra')->group(function () {
        Route::get('cargar_pdf_factura_compra/{factura_compra_cabecera_id}', 'FacturaCompraReporteController@cargarPdfFacturaCompra');
    });
});
