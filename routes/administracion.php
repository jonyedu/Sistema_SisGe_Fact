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
        Route::post('guardar_producto', 'ProductoController@guardarProducto');
        Route::post('actualizar_producto', 'ProductoController@actualizarProducto');
        Route::delete('eliminar_producto', 'ProductoController@eliminarProducto');
    });

    //Submenu de Laboratorio
    Route::namespace('Modulos\Administracion\Laboratorio')->prefix('laboratorio')->group(function () {
        Route::get('cargar_laboratorio_combo', 'LaboratorioController@cargarLaboratorioCombo');
    });

    //Submenu de Grupo
    Route::namespace('Modulos\Administracion\Grupo')->prefix('grupo')->group(function () {
        Route::get('cargar_grupo_combo', 'GrupoController@cargarGrupoCombo');
    });
});
