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

Route::prefix('catalogos')->group(function() {
  Route::get('/', 'CatalogosController@index');
  Route::get('/{catalogo}/index', 'CatalogosController@catalogo');
  Route::get('/{catalogo}/tabla', 'CatalogosController@tabla');

  Route::get('/secciones/create', 'CatalogosController@createSecciones');
  Route::get('/{catalogo}/create', 'CatalogosController@create');
  Route::post('/{catalogo}/store', 'CatalogosController@store');

  Route::get('/secciones/{id}/edit', 'CatalogosController@editSecciones');
  Route::get('/{catalogo}/{id}/edit', 'CatalogosController@edit');
  Route::post('/{catalogo}/{id}/edit', 'CatalogosController@update');
  Route::post('/{catalogo}/{id}/destroy', 'CatalogosController@destroy');
  
  Route::get('/colonias/{cp}', 'ColoniasController@obtenerPorCP');
});
