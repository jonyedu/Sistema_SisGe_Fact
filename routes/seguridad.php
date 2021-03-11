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


Route::group(['prefix' => 'modulos/seguridad', 'middleware' => ['auth:web'], 'verified'], function () {

    /* SubModulo Usuarios */
    Route::namespace('Modulos\Seguridad\Usuario')->prefix('usuario')->group(function () {
        Route::get('cargar_usuario_combo_box/{id}', 'UsuarioController@cargarUsuarioComboBox');
        Route::get('cargar_usuario_table', 'UsuarioController@cargarUsuarioTabla');
        Route::post('modificar_usuario', 'UsuarioController@modificarUsuario');
        Route::post('guardar_usuario', 'UsuarioController@guardarUsuario');
        Route::delete('eliminar_usuario/{id}', 'UsuarioController@eliminarUsuario');
    });

    /* SubModulo Modulo */
    Route::namespace('Modulos\Seguridad\Modulo')->prefix('modulo')->group(function () {
        Route::get('cargar_menu', 'ModuloApiController@cargarMenu');
        Route::get('cargar_modulo_table', 'ModuloApiController@cargarModuloTabla');
        Route::get('cargar_modulo_combo_box', 'ModuloApiController@cargarModuloComboBox');
        Route::post('modificar_modulo', 'ModuloApiController@modificarModulo');
        Route::post('guardar_modulo', 'ModuloApiController@guardarModulo');
        Route::delete('eliminar_modulo/{id}', 'ModuloApiController@eliminarModulo');
    });

    /* SubModulo Submodulo */
    Route::namespace('Modulos\Seguridad\SubModulo')->prefix('sub_modulo')->group(function () {
        Route::get('cargar_sub_modulo_combo_box/{id}', 'SubModuloApiController@cargarSubModuloComboBox');
        Route::get('cargar_sub_modulo_table', 'SubModuloApiController@cargarSubModuloTabla');
        Route::get('cargar_sub_modulo_por_modulo/{id}', 'SubModuloApiController@cargarSubModuloPorModulo');
        Route::post('modificar_sub_modulo', 'SubModuloApiController@modificarSubModulo');
        Route::post('guardar_sub_modulo', 'SubModuloApiController@guardarSubModulo');
        Route::delete('eliminar_sub_modulo/{id}', 'SubModuloApiController@eliminarSubModulo');
    });

    /* SubModulo Perfil */
    Route::namespace('Modulos\Seguridad\Perfil')->prefix('perfil')->group(function () {
        Route::get('cargar_perfil_combo_box', 'PerfilController@cargarPerfilTabla');
        Route::get('cargar_perfil_table', 'PerfilController@cargarPerfilTabla');
        Route::post('modificar_perfil', 'PerfilController@modificarPerfil');
        Route::post('guardar_perfil', 'PerfilController@guardarPerfil');
        Route::delete('eliminar_perfil/{id}', 'PerfilController@eliminarPerfil');
    });

    /* SubModulo Profesion */
    Route::namespace('Modulos\Seguridad\Profesion')->prefix('profesion')->group(function () {
        Route::get('cargar_profesion_combo_box', 'ProfesionController@cargarProfesionTabla');
        Route::get('cargar_profesion_table', 'ProfesionController@cargarProfesionTabla');
        Route::post('modificar_profesion', 'ProfesionController@modificarProfesion');
        Route::post('guardar_profesion', 'ProfesionController@guardarProfesion');
        Route::delete('eliminar_profesion/{id}', 'ProfesionController@eliminarProfesion');
    });

    /* SubModulo Perfil por Usuario */
    Route::namespace('Modulos\Seguridad\PerfilPorUsuario')->prefix('perfil_por_usuario')->group(function () {
        Route::get('cargar_perfil_por_usuario/{idModulo}/{idPerfil}', 'PerfilPorUsuarioController@cargarPerfilPorUsuario');
        Route::get('cargar_menu/{idPerfil}', 'PerfilPorUsuarioController@cargarMenu');
        Route::post('actualizar_perfil_por_usuario', 'PerfilPorUsuarioController@actualizarPerfilPorUsuario');
    });

    /* SubModulo Empresa */
    Route::namespace('Modulos\Seguridad\Empresa')->prefix('empresa')->group(function () {
        Route::get('cargar_empresa_table', 'EmpresaController@cargarEmpresaTabla');
        Route::post('modificar_empresa', 'EmpresaController@modificarEmpresa');
        Route::post('guardar_empresa', 'EmpresaController@guardarEmpresa');
        Route::delete('eliminar_empresa/{id}', 'EmpresaController@eliminarEmpresa');
    });

    /* SubModulo Sucursal */
    Route::namespace('Modulos\Seguridad\Sucursal')->prefix('sucursal')->group(function () {
        Route::get('cargar_sucursal_table', 'SucursalController@cargarSucursalTabla');
        Route::post('modificar_sucursal', 'SucursalController@modificarSucursal');
        Route::post('guardar_sucursal', 'SucursalController@guardarSucursal');
        Route::delete('eliminar_sucursal/{id}', 'SucursalController@eliminarSucursal');
    });
});
