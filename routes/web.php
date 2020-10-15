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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// metronic


//Route::get('/', 'PagesController@index');


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

/////////////////////////////////ciudadanos/////////////////////////
	Route::resource('ciudadanos','CiudadanoController');
	Route::post('/ciudadanos/create', 'CiudadanoController@store');
	Route::put('/{id}', 'CiudadanoController@update');
/////////////////////////////////estructuras/////////////////////////
/////////////////////////////////catalogos/redes_sociales/////////////////////////
Route::resource('catalogos/redes_sociales','RedSocialController');
Route::post('/catalogos/redes_sociales/create', 'RedSocialController@store');
Route::put('/{id}', 'RedSocialController@update');
