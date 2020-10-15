<?php

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

Route::prefix('consultas')->group(function() {
    Route::get('/', 'ConsultasController@index');
    Route::get('/distrito_local', 'ConsultasController@distrito_local');
    Route::get('/seccion', 'ConsultasController@seccion');
    Route::get('/traerTablaIne', 'ConsultasController@TablaIne');
    Route::get('/traerTablaGenerales', 'ConsultasController@TablaGenerales');
    Route::get('/traerTablaLocalizacion', 'ConsultasController@TablaLocalizacion');
    Route::get('/traerTablaDomicilio', 'ConsultasController@TablaDomicilio');
    Route::get('/Concolonia', 'ConsultasController@Concolonia');



});


Route::prefix('consultas_ine')->group(function() {
    Route::get('/', 'ConsultaIneController@index');

});

Route::prefix('consulta_gestiones')->group(function() {
  Route::get('/', 'ConsultaGestionController@index');
  Route::get('/traerTablaGestion', 'ConsultaGestionController@TablaGestion');
  Route::delete('/Eliminar', 'ConsultaGestionController@destroy');
  Route::post('/Estatus', 'ConsultaGestionController@estatus');
  Route::get('/gestiones', 'ConsultaGestionController@gestiones');
  Route::get('/beneficiario', 'ConsultaGestionController@beneficiario');



});

Route::prefix('consulta_validacion')->group(function() {
    Route::get('/', 'ConsultaValidacionController@index');

});
