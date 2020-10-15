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

Route::prefix('usuarios')->middleware('auth')->group(function() {
  Route::get('/', function(){ return view('usuarios::usuarios.index'); });
  Route::get('tabla', 'UsuariosController@tabla');
  Route::get('/create', function(){ return view('usuarios::usuarios.create'); });
  Route::post('/store', 'UsuariosController@store');
  Route::get('/{id}/edit', 'UsuariosController@edit');
  Route::post('/{id}/edit', 'UsuariosController@update');
  Route::post('/{id}/bloquear', 'UsuariosController@bloquear');
  Route::post('/{id}/desbloquear', 'UsuariosController@desbloquear');
});
