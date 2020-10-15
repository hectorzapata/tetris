@extends('layouts.index')
@section('titulo', 'Lista de estructuras')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/estructuras" class="text-muted">Todas las Estructuras</a> </li>
@endsection

@section('style')
    <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/metronic/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>

    <style>
        .requerido { color: red; font-size: .7rem; }
        .w100 { width: 100%; }
        .masGrande { font-size: 1.2em !important; }
        .ml-20 { margin-left: 20px; margin-top: 10px; }
        .mb-10 { padding-bottom: 10px; }
        .pr10 { padding-right: 1rem; }
        .pr-20 { padding-right: 20px; }
        .notas { margin: 0 0 6px 40px; }
        .margenes { padding-left: 26px; margin-top: -1.6rem; margin-right: 0; }

        .der { text-align: right; }
        .gris { color: lightgray !important; }
        .negro { color: black !important; }

        .gris { color: #808080; }
        .bgris { margin: 6px !important; padding: 6px 10px !important; background-color: #F1F4F5; }
        .pl-6 { padding-left: 26px !important; position: absolute; top: 20px; color: #595b5b; }
        .p-3 { padding: 6px !important; }

        .jstree-default .jstree-wholerow { min-height: 44px; }
        .jstree-node, .jstree-open { min-height: 44px !important; line-height: 44px !important; }
        .jstree-default .jstree-anchor { width: 94%; padding: 0; }
        .jstree .jstree-open > .jstree-children { width: 99%; }
        .arbol { width: 100%; /*border: 1px solid #D3D3D3; border-radius: 6px; */ background: none; height: 330px; overflow: auto; }
        .ajusta { padding: 0 0 0 26px !important; margin-top: -1rem !important; }
        .minheight { min-height: 740px; }

        .ui.category.search .results { width: 100% !important; }
        .ui.category.search>.results .category { width: 100% !important; }
        .select2-container { width: 100% !important; }

        .dataTables_wrapper .dataTable th, .dataTables_wrapper .dataTable td { padding: .75rem; }
    </style>
@endsection

@section('content')
    @include('flash::message')

    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon-layer text-primary"></i></span>
                <h3 class="card-label">Estructuras </h3>
            </div>
            <div class="card-toolbar">
                <a href="/estructuras" class="btn btn-light font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/>
                            <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    Regresar
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- col 1 -->
                <div class="col-sm-6 col-xs-12" id='raiz'>
                    <div id="divTree" class="tree-demo">Esperar un momento... </div>
                </div>

                <!-- col 2 -->
                <div class="col-sm-6 col-xs-12">

                    <!-- Niveles -->
                    <div class="row" style="display: none;" id="frmNiveles">
                        <form class="form w100" id="formNiveles" >
                            @csrf
                            <input type="hidden" id="cve_t_estructura" name="cve_t_estructura" value="" />
                            <input type="hidden" id="id_registro" name="id_registro" value="" />

                            <div class="card card-custom">
                                <div class="card-body pb-1">
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label class="label-form">Nombre de la estructura </label>
                                            <input type="text" class="form-control p-3" disabled="disabled" id="nombre_estructura" value="CEABE" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="label-form">Dist. Federal </label>
                                            <input type="text" class="form-control p-3" disabled="disabled" id="distrito_federal" value="2" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="label-form">Estado </label>
                                            <input type="text" class="form-control p-3" disabled="disabled" id="nombre_estado" value="Tamaulipas" />
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-sm-6" id="ctrlPadre">
                                            <label class="label-form w100" id="lblPadre">combo Padre</label>
                                            <select class="custom-select form-control w100" id="comboPadre" name="comboPadre">
                                            </select>
                                        </div>
                                        <div class="col-sm-6" id="ctrlHijo">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-sm-6 col-xs-12">
                                            <label>Meta <small>Total de registros a cumplir </small></label>
                                            <input type="text" class="form-control" placeholder="Meta" id="meta" name="meta" value="@isset($estructura){{$estructura->meta}}@endisset">
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="checkbox-inline">
                                                <label class="checkbox" style="margin-top: 34px !important">
                                                    <input type="checkbox" id="todo_nivel" name="todo_nivel" />
                                                    <span></span>
                                                    Aplicar a todo el nivel
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="/estructuras" class="btn btn-secondary">
                                                <i class="flaticon2-back"></i> Cancelar
                                            </a>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button class="btn btn-primary mr-2" id="btnGuarda">
                                            <i class="flaticon-layer"></i>
                                            Guardar
                                            </button>
                                        </div>
                                    </div>
                                    <br />

                                </div>
                                <!-- fin card-body -->
                            </div>
                            <!-- fin card-custom -->
                        </form>
                    </div>
                    <!-- fin row -->

                </div>
                <!-- fin col 2 -->
            </div>
            <!-- fin row -->
        </div>
        <!-- fin card-body -->

    </div>
    <!--end::Card-->



    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon-layer text-primary"></i></span>
                <h3 class="card-label">Valores del nivel: <span id="tipo_informacion" style="margin-left: 10px;">ninguno</span></h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>

        <div class="card-body" style="margin-top: 1rem; padding: .2rem 2.25rem !important; display: none;" id="muestraTabla">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable" >
                <thead>
                    <tr role="row">
                        <th style="width: 15%;" id="headPadre"> </th>
                        <th style="width: 15%;" id="headHijo"> </th>
                        <th style="width: 30%;">Responsable </th>
                        <th style="width: 22%;">Responsabilidad </th>
                        <th style="width: 8%;">Meta </th>
                        <th style="width: 10%;">Acciones </th>
                    </tr>
                </thead>
            </table>
            <br />
        </div>
        <!-- fin card-body -->
    </div>
    <!--end::Card-->

    @include('estructuras::comun.comun')

@endsection

@section('script')
    @yield('script.comun')

    <!--begin::Page Vendors(used by this page)-->
    <script src="/metronic/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.6"></script>
    <script src="/metronic/assets/js/pages/features/miscellaneous/sweetalert2.js?v=7.0.6"></script>
    <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
    <!--end::Page Vendors-->


    <script>
        let consecutivo = 1;
        let ruta = "/estructuras/";
        let id_padre = 0;
        let id_estructura = 0;
        let nombre1 = '';
        let nombre2 = '';
        let nombre3 = '';
        let nueva = 0;
        let tabla;
        let id_mostrar = 0;
        let nivel_actual = 0;
        let valor_est = 0;

        $(function() {

            $("#comboPadre").select2({ minimumResultsForSearch: 10 });
            $("#comboHijo").select2({ minimumResultsForSearch: 10 });

            busca_estructuras (1);

            $('#comboPadre').change(function (e) {
                e.preventDefault();
                if(nivel_actual == 5 && this.value > 0) {           // nivel_actual = 4

                    llena_combos(1, nombre2, nivel_actual, this.value);
                }
            });


            // Niveles
            $('#btnGuarda').click(function(e) {
                e.preventDefault();

                muestra_loading(1);

                let ruta = '/estructuras/store';
                let chk  = $("input[name='todo_nivel']:checked").val();
                let all = (chk == 'on') ? 1 : 0;


                var form        = document.getElementById("formNiveles");
                var formData    = new FormData (form);
                formData.append('all', all);
                formData.append('valor_est', valor_est);

                $.ajax({
                    url: ruta,
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(r) {
                        llenaTabla(id_mostrar);
                        $('#meta').val(0);
                        $("#todo_nivel").attr('checked', false);

                        muestra_loading(0);

                        // en edicion oculta pantalla captura
                        if (id_estructura > 0)
                            limpia();
                    }
                });

            });

        });


        // Buscar estructuras
        function busca_estructuras (id) {
            muestra_loading(1);

            var datos       = [];

            $('#divTree').jstree('destroy');
            $('#raiz').html('<div id="divTree" class="arbol"> </div>');

            $.ajax({
                url: '/estructuras/lista_estructuras',
                type: 'GET',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
            })
            .always(function(r) {
                let estructuras = r;
                let tamano = Object.keys(r).length;

                // Crear arbol
                if (tamano > 0) {
                    $.each( estructuras, function(key, value) {
                        var padre   = value.id_padre;

                        padre       = (padre == '0' || tamano == 1) ? '#' : padre;
                        // cancela el elemento raiz
                        tamano = 0;

                        descripcion  = value.descripcion || 'sin descripción';
                        descripcion = (descripcion.length > 60) ? descripcion.substr(0, 60) +'...' : descripcion;
                        if (value.id_padre == 0)
                            descripcion = 'Distrito Federal ' +value.distrito_federal +', ' +descripcion;

                        color = (value.descripcion) ? 'black' : 'red';

                            let t = '<div class="row margenes" >';
                                t += '<div class="col-11">';
                                    t += '<span style="color: ' +color +';">' +value.nombre_estructura +'</span>';
                                t += '</div>';
                                t += '<div class="col-1">';
                                if(value.id_padre > 0) {
                                    t += '<span onclick="agrega_estructura(' +value.id +', ' +value.nivel +')" title ="Agregar datos">';
                                        t += '<i class="fa fa-plus pointer" style="color: green;"> </i>';
                                    t += '</span>';
                                }
                                else {
                                    t += '<span onclick="exportaXLS(' +value.id +',0)" title ="Exportar a excel">';
                                        t += '<i class="fas fa-file-excel pointer" style="color: green;"> </i>';
                                    t += '</span>';

                                }
                                t += '</div>';
                            t += '</div>';

                            t += '<div class="row col-12" style="margin-top: -2rem;">';
                                t += '<span class="pl-6">' + descripcion +'</span>';
                            t += '</div>';


                        datos.push({
                            'id': value.id,
                            'parent': padre,
                            'text': t,
                            'descripcion': value.descripcion,
                            'consecutivo': value.consecutivo,
                            'nivel': value.nivel,
                            'nivel_anterior': value.nivel_anterior,
                            'texto_anterior': value.texto_anterior,
                            'valor_anterior': value.valor_anterior,
                            'nombre_estructura': value.nombre_estructura,
                            'distrito_federal': value.distrito_federal,
                            'id_padre': value.id_padre
                        });
                    });


                    $('#divTree').jstree({
                        "core" : {
                            'data' : datos,
                            "multiple" : false,
                            "animation" : 0,
                            'open all' : true,
                            'check_callback': true,
                            'expand_selected_onload': false
                        },
                        'data' : function (node) {
                           return { 'nodo' : node };
//                            return { 'id' : node.id };
                        },
                        "plugins" : [
                            "dnd", "wholerow", "state", "types"
                        ]
                    });

                    var to = false;
                    $('#busca_estructura').keyup(function () {
                        if(to) { clearTimeout(to); }
                        to  = setTimeout(function () {
                                var v = $('#busca_estructura').val();
                                $('#divTree').jstree(true).search(v);
                            }, 250);
                    });

                    // estructura seleccionada
                    $("#divTree").click(function (e) {
                        if (id_estructura == -1) {
                            id_padre = 0;
                        }

                        var node = $("#divTree").jstree("get_selected", true);
                        let id   = node[0].original.id;

                        $('#divTree').jstree("toggle_node", id);

                        // muestra info
                        if(node[0].original.nivel > 0)
                            muestraInfo (node[0].original);

                    });
                }
                muestra_loading(0);
            });

            return false;
        }

        function agrega_estructura (id, nivel) {
            consecutivo ++;

            nivel += 1;
            if (nivel > 6)
                nivel = 6;

            $("#consecutivo").val(consecutivo);
            $('#id_registro').val(0);

            id_padre = id;
            $('#id_padre').val(id);

            editaEstructura (0, consecutivo);
        }

        function editaEstructura (id, nivel) {
            $('#frmNiveles').show();

            realiza_accion = (id == 0) ? 0 : 1;

            if (id == 0) {
                $('#btnGuarda').html('<i class="flaticon-layer"></i> Crear nivel');
                nueva = 0;

                let ruta = "/estructuras/store/" +id_estructura;
                $('#formNiveles').attr('action', ruta);

            }
            else {
                $('#btnGuarda').html('<i class="flaticon2-pen"></i> Actualizar');
                $.ajax({
                    url: '/estructuras/datos_estructura/' +id,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
                })
                .always(function(r) {
                    let estructura = r;

                    $.each(estructura, function(index, ele){
                        $('#id_padre').val(ele.id_padre);

                        $('#nivel').val(ele.nivel);
                        $('#nivel').trigger('change');

//                        $('#descripcion').val(ele.descripcion);
                        $('#consecutivo').val(ele.consecutivo);
                        $('#id_padre').val(ele.id_padre);

                        id_estructura = ele.id_estructura;
                        nueva = ele.id;

                        ruta = "/estructuras/update/" +nueva;
console.log(nueva, ruta);

                        $('#formNiveles').attr('action', ruta);
                    });
//                    $('#descripcion').focus();

                });
            }
        }

        function muestraInfo (node) {
console.log('mI', node);
            muestra_loading(1);

            let id   = node.id;
            let nivel = node.nivel;
            let anterior = node.nivel_anterior;
            let texto = node.descripcion;
            let txtoAnt = node.texto_anterior;
            let valor_anterior = node.valor_anterior;
            id_mostrar = id;
            nivel_actual = nivel;

            nombre1 = node.nombre_estructura;
            nombre2 = node.descripcion;
            nombre3 = node.texto_anterior;

            $('#tipo_informacion').html(texto);
            $('#cve_t_estructura').val(id);

console.log('llamada', anterior, nivel);
console.log(id, nivel, anterior, texto, txtoAnt, valor_anterior);

            anterior = (anterior == 0) ? 1 : anterior;

            if(nivel == 2)
                llena_combos(0, texto, nivel, valor_anterior);
            else {
                if (nivel < 5)
                    llena_combos(0, texto, nivel, valor_anterior);
            }
            //
            // if (nivel == 4)
            //     llena_combos(0, 'DL', 2, 0);

            if (nivel == 5) {   // si el nivel anterior es 4, toma valores de nivel 4

console.log('personalizado', nivel, anterior, id_estructura);
                if(anterior == 4) {
                    $('#lblPadre').html('');

                    $.ajax({
                        url: '/estructuras/llena_combos/5/1',       // ajustar el 1 a la estructura deseada
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
                    })
                    .always(function(r) {
                        $('#comboPadre').html(txtoAnt);

console.log(id_estructura, r);
                        arreglo = r;
                        newOption   = new Option('Selecciona...', 0, false, false);
                        $('#comboPadre').append(newOption).trigger('change');

                        if (arreglo.length > 0) {
                            selected = false;
                            arreglo.forEach (function(ele) {
                                newOption   = new Option(ele.valor, ele.id, selected, selected);
                                $('#comboPadre').append(newOption).trigger('change');
                            });
                        }
                        muestra_loading(0);

                    });
                }
                else
                    llena_combos(0, txtoAnt, anterior, 0);

                llena_combos(1, texto, nivel, 0);
            }

            // llena la tabla correspondiente
            llenaTabla(id);
            muestra_loading(0);

        }

        function llena_combos(cual, texto, opcion, valor = 0) {
            let busca = 1;
            $('#ctrlHijo').html('');

            if (opcion == 1) {
                $('#headPadre').html(nombre2);
                $('#headHijo').html(nombre1);
            }
            else {
                $('#headPadre').html(nombre3);
                $('#lblPadre').html(nombre3);
                $('#headHijo').html(nombre2);
            }

            valor_est = valor;
            comboLlenar = 'comboPadre';
console.log(cual, texto, opcion, valor);
console.log('llena_combos', opcion, valor, nombre1, nombre2, nombre3, cual, texto);
            muestra_loading(1);

            if (cual == 0) {
                $('#lblPadre').html(texto);
            }
            else {
                t  = '<label class="label-form">' +texto +'</label>';
                if(opcion < 5) {
                    t += '<select class="custom-select form-control" id="comboHijo" name="comboHijo">';
                    t += '</select>';

                    $('#ctrlHijo').html(t);

                    comboLlenar = 'comboHijo';
                }
                else {
                    busca = 0;
                    t += '<input type="text" class="form-control" maxlength="150" id="txtHijo" name="txtHijo" />';

                    $('#ctrlHijo').html(t);
                }
            }


            if (busca == 1) {
                $.ajax({
                    url: '/estructuras/llena_combos/' +opcion +'/' +valor,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
                })
                .always(function(r) {
                    $('#' +comboLlenar).html('');
console.log('lc resultado', cual, opcion, valor, r, comboLlenar);
                    arreglo = r;
                    newOption   = new Option('Selecciona...', 0, false, false);
                    $('#' +comboLlenar).append(newOption).trigger('change');

                    if (arreglo.length > 0) {
                        selected = false;
                        let agrega = true;
                        let val_ant = 0;
                        arreglo.forEach (function(ele) {
                            if(opcion == 2) {
                                valor = ele.valor + ' - ' +ele.nombre;
                                if (val_ant != ele.valor) {
                                    agrega = true;
                                    val_ant = ele.valor;
                                }
                                else
                                    agrega = null;
                            }
                            else {
                                agrega = true;
                                valor = ele.valor;
                            }

                            if (agrega) {
                                newOption   = new Option(valor, ele.id, selected, selected);
                                $('#' +comboLlenar).append(newOption).trigger('change');
                            }
                        });
                    }
                    muestra_loading(0);
                });
            }
            else
                muestra_loading(0);

        }


        function llenaTabla(id) {

            if ( $.fn.DataTable.isDataTable('#kt_datatable') ) {
                $('#kt_datatable').DataTable().destroy();
            }
            $('#muestraTabla').show();

            tabla = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: {
                    url: "/estructuras/llena_tabla/" +id,
                },
                columns: [
                    { data: 'padre', name: 'padre' },
                    { data: 'hijo', name: 'hijo' },
                    { data: 'nom_responsable', name: 'nom_responsable' },
                    { data: 'responsabilidad', name: 'responsabilidad' },
                    { data: 'meta', name: 'meta' },
                    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, class: 'acciones' }
                ],
                columnDefs: [
                    { render: function (data, type, row) {
                        return data;
                    }, targets: [0] }
                ],
                createdRow: function ( row, data, index ) {
                    $(row).find('.ui.dropdown.acciones').dropdown();
                },
                language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
            });
        }

        // editar estructura
        function editar(id_est, id_registro, nivel) {
            id_estructura = id_est;     // var global

console.log('editar',id_est, id_registro, nivel);

            // muestra datos
            agrega_estructura (id_est, nivel);
            $('#id_registro').val(id_registro);

            $.ajax({
                url: '/estructuras/datos_registro/' +id_registro,
                type: 'GET',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
            })
            .always(function(r) {
                let estructura = r;

                $.each(estructura, function(index, ele) {
                    $('#id_padre').val(ele.id_padre);

                    $('#nivel').val(ele.nivel);
                    $('#nivel').trigger('change');

//                    $('#descripcion').val(ele.descripcion);
                    $('#consecutivo').val(ele.consecutivo);
                    $('#meta').val(ele.meta);
                    $("input[name='todo_nivel']:checked").val(ele.todo_nivel);

                    $('#comboPadre').val(ele.valor).trigger('change', true);
                    $('#comboPadre').focus();

                    if (nivel == 5) {
                        $('#txtHijo').val(ele.valor_hijo);
                        $('#txtHijo').focus();
                    }

                    labelBtnSave();
                });
            });
        }

        function eliminar(id_est, id_registro) {
            console.log('eliminar', id_est, id_registro);
        }


        function labelBtnSave() {
            if(id_estructura == 0)
                t = '<i class="flaticon-layer"></i> Guardar';
            else
                t = '<i class="flaticon2-pen"></i> Actualizar';
            $('#btnGuarda').html(t);
        }

        function limpia() {
            $('#frmNiveles').hide();

//            $('#descripcion').val(ele.descripcion);
            $('#meta').val(0);
            $("input[name='todo_nivel']:checked").val(0);

            $('#comboPadre').val(0).trigger('change', true);
        }

        function exportaXLS (id) {
            window.open(  "/estructuras/exporta_xls/" +id, "_blank" );
        }
    </script>
@endsection
