<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/catalogo'], function () {
    Route::namespace('Modulos\Inventario\Producto')->prefix('producto')->group(function () {
        Route::get('cargar_productos_all', 'ProductoApiController@cargarProductoAll');
    });
});
