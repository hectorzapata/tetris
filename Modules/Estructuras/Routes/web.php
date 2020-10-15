<?php
Route::prefix('estructuras')->middleware('auth')->group(function() {

    Route::get('/lista_distritos/{id}/{cual}', 'GeneralesController@lista_distritos');
    Route::get('/lista_estructuras', 'GeneralesController@lista_estructuras');
    Route::get('/lista_niveles/{id}/{cual}', 'GeneralesController@lista_niveles');
    Route::get('/llena_combos/{cual}/{dl}', 'GeneralesController@llena_combos');

    Route::get('/datos_nivel/{id}', 'GeneralesController@datos_nivel');
    Route::get('/datos_estructura/{id}', 'GeneralesController@datos_estructura');
    Route::get('/buscaEstructuras/{id}', 'GeneralesController@buscaEstructuras');
    Route::post('/reordena', 'GeneralesController@reordena');
    Route::get('/buscaPersona', 'GeneralesController@buscaPersona');

    // exportar estructura a excel
    Route::get('/exporta_xls/{id}', 'SelectorController@exporta_xls');


    // CRUD estructuras
    Route::get('/llena_tabla/{id}', 'EstructurasController@llena_tabla');
    Route::get('/datos_registro/{id}', 'EstructurasController@datos_registro');

    Route::get('/', 'EstructurasController@index');
    Route::get('/create', 'EstructurasController@create');
    Route::post('/store', 'EstructurasController@store');
    Route::post('/update/{id}', 'EstructurasController@update');
    Route::delete('/delete/{id}', 'EstructurasController@delete');


    Route::prefix('configurar')->group(function() {
        Route::get('/tabla', 'EstructurasConfiguraController@tabla');
        Route::get('/', 'EstructurasConfiguraController@index');

        Route::delete('/destroy/{id}', 'EstructurasConfiguraController@destroy');
        Route::get('/{id}/show', 'EstructurasConfiguraController@show');
        Route::get('/{id}/edit', 'EstructurasConfiguraController@edit');
        Route::post('/{id}/update', 'EstructurasConfiguraController@update');

        Route::get('/create', 'EstructurasConfiguraController@create');
        Route::post('/store', 'EstructurasConfiguraController@store');

        Route::prefix('niveles')->group(function() {
            Route::get('/{id}', 'EstructurasConfiguraController@create_niveles');
            Route::post('/store/{id}', 'EstructurasConfiguraController@store_niveles');
            Route::get('/{id}/edit', 'EstructurasConfiguraController@edit_niveles');
            Route::post('/update/{id}', 'EstructurasConfiguraController@update_niveles');
            Route::delete('/destroy/{id}', 'EstructurasConfiguraController@destroy_niveles');
        });

    });


    Route::prefix('responsables')->group(function() {
        Route::get('/tabla/{id}', 'EstructurasResponsablesController@tabla');
        Route::get('/{id}/{clave}', 'EstructurasResponsablesController@index');

        Route::get('/create', 'EstructurasResponsablesController@create');
        Route::post('/store', 'EstructurasResponsablesController@store');
        Route::get('/{id}/edit', 'EstructurasResponsablesController@edit');
        Route::post('/update/{id}', 'EstructurasResponsablesController@update');
        Route::delete('/destroy/{id}', 'EstructurasResponsablesController@destroy');
    });


    Route::prefix('responsabilidades')->group(function() {
        Route::get('/tabla', 'ResponsabilidadesController@tabla');
        Route::get('/', 'ResponsabilidadesController@index');

        Route::get('/create', 'ResponsabilidadesController@create');
        Route::post('/store', 'ResponsabilidadesController@store');
        Route::get('/{id}/edit', 'ResponsabilidadesController@edit');
        Route::post('/update/{id}', 'ResponsabilidadesController@update');
        Route::delete('/destroy/{id}', 'ResponsabilidadesController@destroy');
    });

    Route::prefix('selector')->group(function() {
        Route::get('/estructura', 'SelectorController@estructura');
        Route::post('/llena_combos_valores', 'SelectorController@llena_combos_valores');
        Route::get('/ubica_valores/{id}', 'SelectorController@ubica_valores');

        Route::post('/llena_responsables', 'SelectorController@llena_responsables');
    });


    Route::prefix('movilizadores')->group(function() {
        Route::get('/', 'EstructurasMovilizadoresController@index');
    });

});
