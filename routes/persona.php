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


Route::group(['prefix' => '/modulos/persona', 'middleware' => ['auth:web'], 'verified'], function () {

    //Submenu de Cliente
    Route::namespace('Modulos\Persona\Cliente')->prefix('cliente')->group(function () {
        Route::get('cargar_cliente_combo_box', 'ClienteController@cargarClienteComboBox');
        Route::get('cargar_cliente_all', 'ClienteController@cargarClienteAll');
        Route::post('guardar_modificar_cliente', 'ClienteController@guardarModificarCliente');
        Route::delete('eliminar_cliente/{id}', 'ClienteController@eliminarCliente');
        Route::get('cargar_cliente_cedula/{cedula}', 'ClienteController@cargarClienteCedula');
    });
    //Submenu de Proveedor
    Route::namespace('Modulos\Persona\Proveedor')->prefix('proveedor')->group(function () {
        Route::get('cargar_proveedor_combo_box', 'ProveedorController@cargarProveedorComboBox');
        Route::get('cargar_proveedor_combo', 'ProveedorController@cargarProveedorCombo');
        Route::get('cargar_proveedor_cedula/{cedula}', 'ProveedorController@cargarProveedorCedula');
        Route::get('cargar_proveedor_all', 'ProveedorController@cargarProveedorAll');
        Route::post('guardar_modificar_proveedor', 'ProveedorController@guardarModificarProveedor');
    });
});
