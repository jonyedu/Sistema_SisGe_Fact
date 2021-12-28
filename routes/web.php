<?php

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


Route::get('/catalogo', 'Publico\Catalogo\CatologoController@index')->where('any', '.*');


Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@authenticate');
});

Route::group(['middleware' => ['auth:web'], 'verified'], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::get('/', function () {
    return redirect()->route('login');
});