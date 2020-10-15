<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/appmovil', function (Request $request) {
//   return $request->user();
// });

Route::group(['middleware' => 'auth:api', 'prefix' => 'appmovil'], function() {
  Route::post('registrarIne', 'AppMovilController@registrarIne');
  Route::post('editarIne/{id}', 'AppMovilController@editarIne');
  Route::get('obtener/{id}', 'AppMovilController@obtener');
});
