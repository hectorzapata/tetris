@extends('layouts.index')
@section('titulo', 'Configurar estructura')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/estructuras/configurar" class="text-muted">Todas las Estructuras</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($estructura) ? "Editar" : "Agregar nivel" }}</span> </li>
@endsection

@section('style')
    <link href="/metronic/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <style>
        .requerido { color: red; font-size: .7rem; }
        .w80 { width: 80%; }
        .masGrande { font-size: 1.2em !important; }
        .ml-20 { margin-left: 20px; margin-top: 10px; }
        .mb-10 { padding-bottom: 10px; }
        .pr10 { padding-right: 1rem; }
        .pr-20 { padding-right: 20px; }
        .notas { margin: 0 0 6px 40px; }
        .margenes { padding-left: 26px; margin-top: -1.6rem; /*margin-right: 10px; */}

        .der { text-align: right; }
        .gris { color: lightgray !important; }
        .negro { color: black !important; }

        .gris { color: #808080; }
        .bgris { margin: 6px !important; padding: 6px 10px !important; background-color: #F1F4F5; }
        .pl-6 { padding-left: 26px !important; position: absolute; top: 20px; color: #595b5b; }

        .jstree-default .jstree-wholerow { min-height: 44px; }
        .jstree-node, .jstree-open { min-height: 44px !important; line-height: 44px !important; }
        .jstree-anchor { width: 94%; }
        .jstree .jstree-open > .jstree-children { width: 99%; }
        .arbol { width: 100%; /*border: 1px solid #D3D3D3; border-radius: 6px; */ background: none; height: 430px; overflow: auto; }
        .ajusta { padding: 0 0 0 26px !important; margin-top: -1rem !important; }
        .minheight { min-height: 740px; }

        .ui.category.search .results { width: 100% !important; }
        .ui.category.search>.results .category { width: 100% !important; }
    </style>
@endsection

@section('content')
    @include('flash::message')


    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon2-gear text-primary"></i></span>
                <h3 class="card-label">Niveles</h3>
            </div>
            <div class="card-toolbar">
                <a href="/estructuras/configurar" class="btn btn-light font-weight-bolder">
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
            <div class="row form-group">
                <!-- col 1 -->
                <div class="col-sm-6 col-xs-12" id='raiz'>
                    <div id="divTree" class="tree-demo">Sin definir... </div>
                </div>

                <!-- col 2 -->
                <div class="col-sm-6 col-xs-12">

                    <!-- Niveles -->
                    <div class="row form-group" style="display: none;" id="frmNiveles">
                        <form class="form" id="formNiveles" method="post" >
                            @csrf
                            <div class="card card-custom">
                                <div class="card-body pb-1">
                                    <div class="row form-group">
                                        <div class="col-sm-6 col-xs-12">
                                            <label>Tipo de campo <span class="requerido">requerido</span></label>

                                            <input type="hidden" id="consecutivo" name="consecutivo" value="{{$consecutivo}}" />
                                            <input type="hidden" id="id_padre" name="id_padre" value="0" />

                                            <select class="custom-select form-control" id="nivel" name="nivel">
                                                @isset($tipocampos)
                                                @foreach($tipocampos as $key => $value)
                                                <option value="{{$value->cve_cat_tipocampo}}" @isset($estructura){{'selected="selected"'}}@endisset>{{$value->tipo_campo}}</option>
                                                @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-xs-12 gris text-right">
                                            <label># consecutivo: {{ $consecutivo }}</label>
                                        </div>

                                    </div>


                                    <div class="row form-group">
                                        <div class="col-sm-12 col-xs-12">
                                            <label>Descripción <span class="requerido">requerido</span></label>
                                            <input type="text" class="form-control" placeholder="Descripción del tipo de campo" id="descripcion" name="descripcion" value="@isset($estructura){{$estructura->descripcion}}@endisset">
                                        </div>
                                    </div>
                                </div>
                                <!-- fin card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="/estructuras/configurar" class="btn btn-secondary">
                                                <i class="flaticon2-back"></i> Cancelar
                                            </a>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button  type="submit" class="btn btn-primary mr-2" id="btnGuarda">
                                            <i class="flaticon2-gear"></i>
                                            {{ ($nueva > 0) ? "Guardar" : "Crear nivel" }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- fin card-footer -->
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
    <br />

    @include('estructuras::comun.comun')

@endsection

@section('script')
    @yield('script.comun')

    <!--begin::Page Vendors(used by this page)-->
    <script src="/metronic/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.6"></script>
    <script src="/metronic/assets/js/pages/features/miscellaneous/sweetalert2.js?v=7.0.6"></script>
    <!--end::Page Vendors-->


    <script>
        let consecutivo = @JSON($consecutivo);
        let ruta = "/estructuras/configurar";
        let id_padre = 0;
        let id_estructura = @JSON($cve_t_estructura);
        let nueva = 0;

        $(function() {

            $("#tipo_campo").select2({ minimumResultsForSearch: 10 });
            busca_estructuras (@JSON($cve_t_estructura));

            // Niveles
            FormValidation.formValidation(
                document.getElementById('formNiveles'),
                {
                    fields: {
                        nivel: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor, selecciona el tipo de campo'
                                }
                            }
                        },
                        descripcion: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor, escribe la descripción'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit()
                    }
                }
            );

        });


        // Buscar estructuras
        function busca_estructuras (id) {

            var datos       = [];

            mloader(1);

            $('#divTree').jstree('destroy');
            $('#raiz').html('<div id="divTree" class="arbol"> </div>');

            $.ajax({
                url: '/estructuras/buscaEstructuras/' +id,
                type: 'GET',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
            })
            .always(function(r) {
                let estructuras = r;
                let tamano = Object.keys(r).length;

    console.log(id, tamano, r);
                // Crear arbol
                if (tamano > 0) {
                    $.each( estructuras, function(key, value) {
                        var padre   = value.id_padre;

                        padre       = (padre == '0' || tamano == 1) ? '#' : padre;
                        // cancela el elemento raiz
                        tamano = 0;

                        descripcion  = value.descripcion || 'sin descripción';
                        color = (value.descripcion) ? 'black' : 'red';

                            let t = '<div class="row margenes" >';
                                t += '<div class="col-10">';
                                    t += '<span style="color: ' +color +';">' +value.nombre_estructura +'</span>';
                                t += '</div>';
                                t += '<div class="col-2">';

                                    if (value.elimina == 0) {
                                        t += '<span class="pr10" onclick="elimina_estructura(' +value.id +')" title ="Eliminar nivel">';
                                            t += '<i class="fa fa-times pointer" style="color: red;"> </i>';
                                        t += '</span>';
                                    }
                                    t += '<span class="pr10" onclick="editaEstructura(' +value.id +', ' +value.nivel+')" title ="Editar nivel">';
                                        t += '<i class="fa fa-edit pointer" style="color: orange;"> </i>';
                                    t += '</span>';
//                                    if (value.id_padre == 0) {
                                        t += '<span onclick="agrega_estructura(' +value.id +', ' +value.nivel +')" title ="Agregar niveles">';
                                            t += '<i class="fa fa-plus pointer" style="color: green;"> </i>';
                                        t += '</span>';
//                                    }
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
                            return { 'id' : node.id };
                        },
                        "plugins" : [
                            "dnd", "wholerow", "state", "types"
                        ]
                    }).bind("move_node.jstree", function(e, data) {
console.log(data);

                        Swal.fire({
                            text: "Estás seguro(a)?",
                            title: "Realmente deseas cambiar de lugar este campo?",
                            icon: "warning",
                            showCancelButton: true,
                            cancelButtonText: "No",
                            confirmButtonText: "Si, moverlo!"
                        }).then(function(result) {
                            if (result.value) {
                                let newpos = data.position;
                                let oldpos = data.old_position;
                                $.ajax({
                                    url: '/estructuras/reordena',
                                    type: 'POST',
                                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                                    data: { newpos: newpos, oldpos: oldpos, id: id_estructura}
                                })
                                .always(function(r) {
console.log(r);
                                });

                            }
                            else {
                                window.location.reload();
                            }
                        });

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

                        var node = $("#divTree").jstree("get_selected");

                        $('#divTree').jstree("toggle_node", node);
                    });
                }

                mloader(0);
            });

            return false;
        }

        function agrega_estructura (id, nivel) {
            consecutivo ++;

            nivel += 1;
            if (nivel > 6)
                nivel = 6;

            $("#consecutivo").val(consecutivo);

            id_padre = id;
            $('#id_padre').val(id);

            editaEstructura (0, consecutivo);
        }

        function editaEstructura (id, nivel) {
            $('#frmNiveles').show();

            realiza_accion = (id == 0) ? 0 : 1;

            if (id == 0) {
                $('#btnGuarda').html('<i class="flaticon2-gear"></i> Crear nivel');
                nueva = 0;

                let ruta = "/estructuras/configurar/niveles/store/" +id_estructura;
                $('#formNiveles').attr('action', ruta);

            }
            else {
                $('#btnGuarda').html('<i class="flaticon2-gear"></i> Guardar');
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

                        $('#descripcion').val(ele.descripcion);
                        $('#consecutivo').val(ele.consecutivo);
                        $('#id_padre').val(ele.id_padre);

                        id_estructura = ele.id_estructura;
                        nueva = ele.id;

                        ruta = "/estructuras/configurar/niveles/update/" +nueva;
console.log(nueva, ruta);

                        $('#formNiveles').attr('action', ruta);
                    });
                    $('#descripcion').focus();

                });
            }
        }

        function mloader (opcion) {
            valor = (opcion == 1) ? 'show' : 'hide';
            $('.tiny.modal.loader')
              .modal(valor);
             return false;
        }
    </script>
@endsection
