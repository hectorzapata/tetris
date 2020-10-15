    <div class="row form-group w100" >
        <div class="col-sm-6">
            <label class="label-form">Selecciona Estructura</label>
            <select class="custom-select form-control" id="id_estructura" name="id_estructura">
            </select>
        </div>
        <div class="col-sm-3">
            <label class="label-form">Dist. Federal </label>
            <input type="text" class="form-control p-3" disabled="disabled" id="distrito_federal" value="" />
        </div>
        <div class="col-sm-3">
            <label class="label-form">Estado </label>
            <input type="text" class="form-control p-3" disabled="disabled" id="nombre_estado" value="" />
        </div>
    </div>

    <!-- seleccion de valores -->
    <div class="row form-group w100" >
        <div class="col-sm-3">
            <label class="label-form">Nombre del nivel </label>
            <select class="custom-select form-control" id="id_nivel" name="id_nivel">
            </select>
        </div>
        <div class="col-sm-3" id="ctrlUno">
        </div>
        <div class="col-sm-3" id="ctrlDos">
        </div>
        <div class="col-sm-3">
            <label class="label-form">Responsable </label>
            <select class="custom-select form-control" id="id_responsable" name="id_responsable">
                <option value="0"> Seleccionar responsable </option>
            </select>
        </div>
    </div>

    <div class="spinner spinner-track spinner-primary centra-spinner" id="loading" style="display: none; margin: 10px auto !important; width: 4% !important; text-align: center !important;"></div>
    <p style="height: 2px; "> </p>
    <br />


@section('script.selector')
    <script>
        let _estructuras = [];
        let _valores = [];
        let nombre1 = '';
        let nombre2 = '';
        let nombre3 = '';
        let nivel_actual = 0;
        let id_mostrar = 0;
        let _id_estructura = @JSON($id_estructura);

        let _id_est = 0;
        let _valor_padre = 0;
        let _valor_hijo = 0;

        $(function() {
            // carga estructuras iniciales
            $("#id_estructura").select2({ minimumResultsForSearch: 10 });
            $("#id_nivel").select2({ minimumResultsForSearch: 10 });
            $("#id_responsable").select2({ minimumResultsForSearch: 10 });

            $.ajax({
                url: '/estructuras/lista_estructuras',
                type: 'GET',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
            })
            .always(function(r) {
                _estructuras = r;
console.log('inicio', r);

                $('#id_estructura').html('');
                if(Object.keys(_estructuras).length > 0) {
                    let id = -1;
                    selected = false;

                    newOption   = new Option('Favor de seleccionar nivel', 0, selected, selected);
                    $('#id_nivel').append(newOption);

                    _estructuras.forEach (function(ele) {
                        if(ele.id_padre == 0) {
                            if(id == -1) {
                                id = ele.id;
                            }
                            newOption   = new Option(ele.nombre_estructura, ele.nivel, selected, selected);
                            $('#id_estructura').append(newOption).trigger('change');
                        }
                        else {
                            newOption   = new Option(ele.descripcion +' (' +ele.nombre_estructura +')', ele.nivel, selected, selected);
                            $('#id_nivel').append(newOption);
                        }
                    });

                    // datos estructura
                    if (_id_estructura == 0)
                        _datos_estructura(id);
                    else
                        _estructura_coloca (_id_estructura);
                }
            });



            $('#id_nivel').change(function(e) {
                let esteValor = $('#id_nivel').val();

                _estructuras.forEach (function(ele) {           // _estructuras
                    if(ele.nivel == esteValor) {
    console.log('ele', ele, ele.id, esteValor);
                        let id   = ele.cve_t_estructura;
                        let nivel = ele.nivel;
                        let anterior = ele.nivel_anterior;
                        let texto = ele.descripcion;
                        let txtoAnt = ele.texto_anterior;
                        let valor_anterior = ele.valor_anterior;
                        id_mostrar = id;
                        nivel_actual = nivel;

                        nombre1 = ele.nombre_estructura;
                        nombre2 = ele.descripcion;
                        nombre3 = ele.texto_anterior;

                        $('#tipo_informacion').html(texto);
                        $('#cve_t_estructura').val(id);

                        anterior = (anterior == 0) ? 1 : anterior;

                        if(nivel == 2)
                            _llena_combos(0, texto, nivel, valor_anterior);
                        else {
                            if (nivel < 5)
                                _llena_combos(0, texto, nivel, valor_anterior);
                        }

                        if (nivel == 5) {   // si el nivel anterior es 4, toma valores de nivel 4
                            if(anterior == 4) {
                                t  = '<label class="label-form">' +txtoAnt +'</label>';
                                t += '<select class="custom-select form-control" id="comboPadre" name="comboPadre">';
                                t += '</select>';

                                $('#ctrlUno').html(t);
                                $("#comboPadre").select2({ minimumResultsForSearch: 10 });

                                // comboPadre event
                                $('#comboPadre').change(function (e) {
                                    e.preventDefault();

                                    if(nivel_actual == 5 && esteValor > 0) {
                                        _llena_combos(1, nombre2, nivel_actual, this.value);
                                    }
                                });

                                $.ajax({
                                    url: '/estructuras/llena_combos/5/' +_id_est,
                                    type: 'GET',
                                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
                                })
                                .always(function(r) {
                                    $('#comboPadre').html(txtoAnt);
                                    arreglo = r;
                                    newOption   = new Option('Selecciona...', 0, false, false);
                                    $('#comboPadre').append(newOption).trigger('change');

                                    if (arreglo.length > 0) {
                                        selected = false;

                                        arreglo.forEach (function(ele) {
                                            if (_valor_padre > 0)
                                                selected = (_valor_padre == ele.id) ? true : false;
                                            else
                                                selected = false;

console.log('_valor_padre', _valor_padre, ele.id, selected, ele.valor);

                                            newOption   = new Option(ele.valor, ele.id, selected, selected);
                                            $('#comboPadre').append(newOption).trigger('change');
                                        });
                                    }
                                });
                            }
                            else
                                _llena_combos(0, txtoAnt, anterior, 0);
                        }
                    }
                });
            });



            $('#id_estructura').change(function (e) {
                e.preventDefault();
                _datos_estructura(this.value);
            });

        });

        function _datos_estructura (id) {
            _estructuras.forEach (function(ele) {
                if(ele.id == id) {
                    $('#distrito_federal').val(ele.distrito_federal);
                    $('#nombre_estado').val(ele.nombre_estado);
                    _id_est = ele.id_estructura;
                }
            });
        }


        function _llena_combos(cual, texto, opcion, valor = 0) {
            comboLlenar = 'comboEstructura';


            t  = '<label class="label-form">' +texto +'</label>';
            t += '<select class="custom-select form-control" id="comboEstructura" name="comboEstructura">';
            t += '</select>';

            if (cual == 0) {
                $('#ctrlUno').html(t);
            }
            else {
                $('#ctrlDos').html(t);
            }
            $("#comboEstructura").select2({ minimumResultsForSearch: 10 });


            let valor1 = 0;
            let valor_est = $('#id_estructura').val();

            $('#loading').show();

            $.ajax({
                url: '/estructuras/selector/llena_combos_valores',
                type: 'POST',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                data: { opcion: opcion, id_est: _id_est, valor: valor, valor1: valor1 }
            })
            .always(function(r) {
                $('#' +comboLlenar).html('');

//console.log(cual, comboLlenar, r);
                arreglo = r;
                newOption   = new Option('Selecciona...', 0, false, false);
                $('#' +comboLlenar).append(newOption);  //.trigger('change');

                if (arreglo.length > 0) {

                    selected = false;
                    let agrega = true;
                    let val_ant = 0;
                    arreglo.forEach (function(ele) {
                        if (_valor_hijo > 0 && opcion == 5)
                            selected = (_valor_hijo == ele.id) ? true : false;
                        else
                            selected = false;

                        newOption   = new Option(ele.nombre, ele.id, selected, selected);
                        $('#' +comboLlenar).append(newOption);
                    });

                    if (_valor_hijo > 0 && opcion == 5 && cual == 1 && selected) {
                        $('#' +comboLlenar).trigger('change', true);
                    }

                    // combo responsables
                    comboResponsables_ (0);
                }
                $('#loading').hide();
            });
        }

        function _estructura_coloca(id) {
            // busca valores
            $.ajax({
                url: '/estructuras/selector/ubica_valores/' +id,
                type: 'GET',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
            })
            .always(function(r) {

                if (r) {
                    _valores = r.valores;

                    // selecciona estructura

                    _valores.forEach (function(el) {           // _estructuras
                        _datos_estructura(el.id_estructura);
                        _valor_padre = el.valor;
                        _valor_hijo = id;

                        $('#id_nivel').val(el.nivel).trigger('change');
                    });                    
                }
            });
        }

        function comboResponsables_ (id) {

            $('#loading').show();
            $('#id_responsable').val(null).trigger('change');

            $.ajax({
                url: '/estructuras/selector/llena_responsables',
                type: 'POST',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                data: { id: id, filtro: _valor_hijo }
            })
            .always(function(r) {
                $('#id_responsable').html('');

                arreglo = r;
console.log('responsables', arreglo);
                newOption   = new Option('Selecciona...', 0, false, false);
                $('#id_responsable').append(newOption);

                if (arreglo.length > 0) {

                    selected = false;
                    arreglo.forEach (function(ele) {
                        if (id > 0)
                            selected = (id == ele.id) ? true : false;
                        else
                            selected = false;

                        newOption   = new Option(ele.nombre, ele.id, selected, selected);
                        $('#id_responsable').append(newOption);
                    });

                    if (id > 0) {
                        $('#id_responsable').trigger('change', true);
                    }
                }
                $('#loading').hide();
            });
        }
    </script>
@endsection
