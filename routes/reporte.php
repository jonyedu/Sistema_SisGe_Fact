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


Route::group(['prefix' => 'modulos/reporte', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de
    Route::namespace('Modulos\Reporte\FacturaCompra')->prefix('factura_compra')->group(function () {
        Route::get('cargar_pdf_factura_compra/{factura_compra_cabecera_id}/{enviar}', 'FacturaCompraReporteController@cargarPdfFacturaCompra');
        Route::get('cargar_pdf_factura_compra_fecha/{fechadesde}/{fechahasta}/{id}', 'FacturaCompraReporteController@cargarFechaCompra');

    });

    //ventas
    Route::namespace('Modulos\Reporte\FacturaVenta')->prefix('factura_venta')->group(function () {

        Route::get('cargar_pdf_factura_venta/{id}/{id_ide}/{enviar}', 'FacturaVentaReporteController@cargarPdfFacturaVenta');
        Route::get('cargar_pdf_factura_venta_fecha/{fechadesde}/{fechahasta}/{id}', 'FacturaVentaReporteController@cargarFechaVenta');

    });

    //credito
    Route::namespace('Modulos\Reporte\FacturaVenta')->prefix('factura_credito')->group(function () {
        Route::get('cargar_pdf_factura_credito/{id}', 'FacturaVentaReporteController@cargarPdfFacturaVentaCredito');
    });


    //proveedor
    Route::namespace('Modulos\Reporte\Proveedores')->prefix('proveedores')->group(function () {
        Route::get('cargar_pdf_proveedor/{id}', 'ReporteProveedores@ReporteProveedor');
    });

    //cliente
    Route::namespace('Modulos\Reporte\Proveedores')->prefix('cliente')->group(function () {
        Route::get('cargar_pdf_cliente/{id}', 'ReporteProveedores@cargarClienteAll');
    });
});
