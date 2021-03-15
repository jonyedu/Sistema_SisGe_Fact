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


Route::group(['prefix' => '/modulos/administracion', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de Producto
    Route::namespace('Modulos\Administracion\Producto')->prefix('producto')->group(function () {
        Route::get('cargar_all_producto', 'ProductoController@cargarProductoTabla');
        Route::post('guardar_modificar_producto', 'ProductoController@guardarModificarProducto');
        /* Route::post('guardar_producto', 'ProductoController@guardarProducto');
        Route::post('actualizar_producto', 'ProductoController@actualizarProducto'); */
        Route::delete('eliminar_producto/{id}', 'ProductoController@eliminarProducto');
    });
//
    //Submenu de Laboratorio
    Route::namespace('Modulos\Administracion\Laboratorio')->prefix('laboratorio')->group(function () {
        Route::get('cargar_laboratorio_combo_box', 'LaboratorioController@cargarLaboratorioComboBox');
        Route::get('cargar_laboratorio_combo', 'LaboratorioController@cargarLaboratorioCombo');
        Route::get('cargar_laboratorio_all', 'LaboratorioController@cargarLaboratorioAll');
        //guardarModificarLaboratorio
        Route::post('guardar_modificar_laboratorio', 'LaboratorioController@guardarModificarLaboratorio');
    });

    //Submenu de Grupo
    Route::namespace('Modulos\Administracion\Grupo')->prefix('grupo')->group(function () {
        Route::get('cargar_grupo_combo_box', 'GrupoController@cargarGrupoComboBox');
        Route::get('cargar_grupo_table', 'GrupoController@cargarGrupoTabla');
        Route::post('guardar_modificar_grupo', 'GrupoController@guardarModificarGrupo');
        Route::delete('eliminar_grupo/{id}', 'GrupoController@eliminarGrupo');
    });

    //Submenu de Facturacion Venta
    Route::namespace('Modulos\Procesos\Facturacion\Ventas')->prefix('facturacion')->group(function () {
        Route::get('cargar_facturas_dia', 'fact_ventas_cabecera@cargarFacturasDelDia');
        Route::get('productos_invo/{name}', 'fact_ventas_cabecera@cargarProductosInventario');
      
    });

});
