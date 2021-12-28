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


Route::group(['prefix' => 'modulos/transaccion', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de Facturacion Compra
    Route::namespace('Modulos\Transaccion\FacturaCompra')->prefix('factura_compra')->group(function () {
        Route::post('guardar_modificar_factura_compra', 'FacturaCompraController@guardarModificarFacturaCompra');
        Route::get('cargar_all_factura_compra_cabecera', 'CompraCabeceraController@cargarCompraCabeceraTabla');
        Route::get('consultar_no_factura/{no_factura}', 'FacturaCompraController@consultarNoFactura');
        Route::delete('eliminar_factura_compra/{factuca_compra_cabecera_id}', 'FacturaCompraController@eliminarFacturaCompra');
        Route::get('cargar_producto_por_proveedor/{proveedor_id}', 'CompraCabeceraController@cargarProductoPorProveedor');
    });

    //Submenu de Facturacion Venta
    Route::namespace('Modulos\Transaccion\FacturaVenta')->prefix('factura_venta')->group(function () {
        Route::get('consultar_no_factura/{no_factura}', 'FacturaVentaController@consultarNoFactura');
        Route::get('cargar_facturas_dia', 'VentasCabeceraController@cargarFacturasDelDia');
        Route::get('productos_fact_inve/{id}/{id_factura}/{id_producto}', 'VentasCabeceraController@cargarProductosInventarioPorTipos');
        Route::delete('eliminar_factura_venta/{factuca_venta_cabecera_id}', 'FacturaVentaController@eliminarFacturaVenta');
        Route::get('productos_invo/{este}', 'VentasCabeceraController@cargarProductosInventario');
        //configuraciones
        Route::get('config_tipo', 'VentasCabeceraController@cargar_tipo');
        //cargar_tarjetas
        Route::get('cargar_tarjeta', 'VentasCabeceraController@cargar_tarjetas');
         //cargar_tarjetas
        Route::get('cargar_banco', 'VentasCabeceraController@cargar_bancos');
         //grabar guardarFacturaVenta
        Route::post('guardar_factura', 'VentasCabeceraController@guardarFacturaVenta');
         //cargar_forma_pago
        Route::get('cargar_forma', 'VentasCabeceraController@cargar_forma_pago');
        Route::get('cargar_forma_id/{id}', 'VentasCabeceraController@cargar_forma_pago_id');

    });


    Route::namespace('Modulos\Transaccion\Creditos')->prefix('creditos_venta')->group(function () {
        Route::get('cargar_ccreditos', 'Creditos@cargarClientes');
        //cargarClientesDetalles
        Route::get('cargar_detalle/{id}', 'Creditos@cargarClientesDetalles');
        //updatecuota
        Route::post('update_cuota', 'Creditos@updatecuota');
     
    
    });

    Route::namespace('Modulos\Transaccion\Arqueo')->prefix('arque_caja')->group(function () {
        Route::get('cargar_arque', 'ArqueoCaja@cargarTiposArqueo');
        //guardar_arque
        Route::post('cargar_grabar', 'ArqueoCaja@guardar_arque');
        //consultar_arqueo
        Route::get('consultar_arqueo', 'ArqueoCaja@consultar_arqueo');
    });
});


