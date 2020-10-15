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

Route::prefix('registro')->group(function() {
  // Route::get('/', function(){ return view('registro::registro.index'); });
  Route::get('/', 'RegistroController@index');
  Route::get('/create', 'RegistroController@create');
  Route::get('tabla', 'RegistroController@tabla');
  //Route::get('/create', function(){ return view('registro::registro.create'); });
  Route::post('/create', 'RegistroController@store');
  Route::get('/create/traerColonia', 'RegistroController@colonia');
  Route::get('/create/traerCurp', 'RegistroController@curp');
  Route::get('/Suspender', 'RegistroController@suspender');
  Route::get('/Activar', 'RegistroController@activar');
  Route::post('/suspender_registro', 'RegistroController@suspender_registro');
  Route::post('/activar_registro', 'RegistroController@activar_registro');
  Route::get('/{id}/edit', 'RegistroController@edit');


  Route::put('/{id}', 'RegistroController@update');
  Route::delete('/destroy', 'RegistroController@destroy');
  Route::post('/borrar_telefono', 'RegistroController@borrar_telefono');
  Route::post('/borrar_red', 'RegistroController@borrar_red');
  Route::get('/{id}/show', 'RegistroController@show');
  Route::post('/create/curpBuscar', 'RegistroController@curpSubmit');
  Route::post('/create/claveBuscar', 'RegistroController@Claveelector');
  Route::post('/create/Distritos', 'RegistroController@Distritos');
  Route::post('/create/Entidades', 'RegistroController@Entidades');
  Route::post('/create/EntidadesMunicipios', 'RegistroController@EntidadesMunicipios');

  Route::get('/gestiones', 'RegistroController@gestiones');
  Route::get('/tablaGestion/{id}', 'RegistroController@tablaGestion');



///////////////////// nueva gestion ////////////////////////////
  Route::get('/{id}/Nuevagestion', 'GestionesController@nuevaGestion');


  // Route::prefix('selector')->group(function() {
  //   Route::get('/estructura', 'RegistroController@estructura');
  //   Route::post('/llena_combos_valores', 'RegistroController@llena_combos_valores');
  //   Route::get('/ubica_valores/{id}', 'RegistroController@ubica_valores');
  //
  //   Route::post('/llena_responsables', 'RegistroController@llena_responsables');
  //    });

  // Route::get('/lista_estructuras', 'RegistroController@lista_estructuras');



});

// Route::prefix('estructuras')->group(function() {
//     Route::prefix('selector')->group(function() {
//         Route::get('/estructura', 'SelectorController@estructura');
//         Route::post('/llena_combos_valores', 'SelectorController@llena_combos_valores');
//         Route::get('/ubica_valores/{id}', 'SelectorController@ubica_valores');
//
//         Route::post('/llena_responsables', 'SelectorController@llena_responsables');
//     });
// });


Route::prefix('registro_suspendido')->group(function() {
  /////////////// REGISTRO SUSPENDIDO ///////////////////////////////
  Route::get('/', 'RegistroSuspendidoController@index');
  Route::get('tablaSuspendida', 'RegistroSuspendidoController@tablaSuspendida');
  Route::get('/Activar', 'RegistroSuspendidoController@activar');
  Route::post('/activar_registro', 'RegistroSuspendidoController@activar_registro');

});

Route::prefix('gestiones')->group(function() {
  /////////////// GESTIONES  ///////////////////////////////
  Route::get('/', 'GestionesController@index');
  Route::get('/create', 'GestionesController@create');
  Route::post('/create', 'GestionesController@store');
  Route::post('/create/BuscarPersona', 'GestionesController@BuscarPersona');
  Route::post('/create/TraerPersona', 'GestionesController@TraerPersona');
  Route::get('tabla', 'GestionesController@tabla');
  Route::get('buscarPersonas/{query}', 'GestionesController@searchPersona');
  Route::get('/{id}/edit', 'GestionesController@edit');
  Route::put('/{id}', 'GestionesController@update');
  Route::delete('/Eliminar', 'GestionesController@destroy');
  Route::post('/Estatus', 'GestionesController@estatus');
  Route::get('/{id}/show', 'GestionesController@show');
  Route::get('/tablaBeneficiarios', 'GestionesController@tablaBeneficiarios');
  Route::post('/GuardarBeneficiario', 'GestionesController@GuardarBeneficiario');
  //Route::delete('/EliminarBeneficiario', 'GestionesController@EliminarBeneficiario');
  Route::get('/search', 'GestionesController@search');
  Route::get('/search2', 'GestionesController@search2');

  Route::post('/create/TraerPersonas', 'GestionesController@TraerPersonas');

  ////////////////////////////////////////////////////////////////////
  Route::post('/EliminarBeneficiario', 'GestionesController@EliminarBeneficiario');
  Route::post('/Bitacora', 'GestionesController@Bitacora');
});
