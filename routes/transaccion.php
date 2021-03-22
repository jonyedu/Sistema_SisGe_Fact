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

    //Submenu de Facturacion Venta
    Route::namespace('Modulos\Transaccion\FacturaVenta')->prefix('factura_venta')->group(function () {
        Route::get('cargar_facturas_dia', 'VentasCabeceraController@cargarFacturasDelDia');
        Route::get('productos_invo/{name}', 'VentasCabeceraController@cargarProductosInventario');
    });

});
