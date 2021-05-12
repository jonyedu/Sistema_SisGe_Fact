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


Route::group(['prefix' => '/modulos/inventario', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de Grupo
    Route::namespace('Modulos\Inventario\Grupo')->prefix('grupo')->group(function () {
        Route::get('cargar_grupo_combo_box', 'GrupoController@cargarGrupoComboBox');
        Route::get('cargar_grupo_table', 'GrupoController@cargarGrupoTabla');
        Route::post('guardar_modificar_grupo', 'GrupoController@guardarModificarGrupo');
        Route::delete('eliminar_grupo/{id}', 'GrupoController@eliminarGrupo');
    });

    //Submenu de Producto
    Route::namespace('Modulos\Inventario\Producto')->prefix('producto')->group(function () {
        Route::get('cargar_all_producto', 'ProductoController@cargarProductoTabla');
        Route::get('producto_por_id/{id}', 'ProductoController@cargarProductoPorId');
        Route::get('verificar_stock_producto_all', 'ProductoController@verificarStockProductoAll');
        Route::post('guardar_modificar_producto', 'ProductoController@guardarModificarProducto');
        Route::delete('eliminar_producto/{id}', 'ProductoController@eliminarProducto');
        //costos
        Route::get('cargar_costo/{id}', 'ProductoController@cargarProductocostoId');
    });




});
