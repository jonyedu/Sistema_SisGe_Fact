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


Route::group(['prefix' => '/modulos/transaccion', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de Facturacion Compra
    Route::namespace('Modulos\Transaccion\FacturaCompra')->prefix('factura_compra')->group(function () {
        Route::post('guardar_modificar_factura_compra', 'FacturaCompraController@guardarModificarFacturaCompra');
        Route::get('cargar_all_factura_compra_cabecera', 'CompraCabeceraController@cargarCompraCabeceraTabla');
        Route::get('consultar_no_factura/{no_factura}', 'FacturaCompraController@consultarNoFactura');
        Route::get('cargar_producto_por_proveedor/{proveedor_id}', 'CompraCabeceraController@cargarProductoPorProveedor');
    });

    //Submenu de Facturacion Venta
    Route::namespace('Modulos\Transaccion\FacturaVenta')->prefix('factura_venta')->group(function () {
        Route::get('cargar_facturas_dia', 'VentasCabeceraController@cargarFacturasDelDia');
        Route::get('productos_invo/{este}', 'VentasCabeceraController@cargarProductosInventario');
        //configuraciones
        Route::get('config_tipo', 'VentasCabeceraController@cargar_tipo');
    });



});
