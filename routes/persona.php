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

    //Submenu de Proveedor
    Route::namespace('Modulos\Persona\Proveedor')->prefix('proveedor')->group(function () {
        Route::get('cargar_proveedor_combo_box', 'ProveedorController@cargarProveedorComboBox');
        Route::get('cargar_proveedor_combo', 'ProveedorController@cargarProveedorCombo');
        Route::get('cargar_proveedor_all', 'ProveedorController@cargarProveedorAll');
        Route::post('guardar_modificar_proveedor', 'ProveedorController@guardarModificarProveedor');
    });

});
