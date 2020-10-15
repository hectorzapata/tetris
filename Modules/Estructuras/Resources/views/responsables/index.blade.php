@extends('layouts.index')
@section('titulo', 'Estructuras')
@section('acciones', '')
@section('breadcumb')
    <li class="breadcrumb-item item-active"><a href="/estructuras" class="text-muted">Todas las Estructuras</a> </li>
    <li class="breadcrumb-item"><span class="text-muted">Responsables </span> </li>
@endsection

@section('style')
    <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered { min-height: 36px; width: 100% !important; }
        .bold { font-weight: bold; }
        .w100 { width: 100% !important; }
    </style>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon-user text-primary"></i></span>
                <h3 class="card-label">{{ isset($responsable) ? "Editar responsable " . $nombre_completo : "Nuevo responsable" }}</h3>
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


        <form class="form" id="formResponsables" method="post" >
            @csrf
            <div class="card card-custom">
                <div class="card-body pb-1">

                    {!! $estructura_seleccionada !!}

                    <div class="fieldset" style="padding: 10px; background-color: #EEF0F8;">
                        <div class="row" >
                            <input type="hidden" name="id_responsable" value="@isset($responsable){{$responsable->cve_t_estructura_responsable}}@else{{'0'}}@endisset" />
                            <!-- <div class="col-sm-3 col-xs-12">
                                <label>Buscar persona por </label>
                                <div class="radio-inline">
                                    <label class="radio radio-outline radio-success">
                                        <input type="radio" name="buscapor" value="0" checked="checked" />
                                        <span></span>
                                        CURP
                                    </label>
                                    <label class="radio radio-outline radio-success">
                                        <input type="radio" name="buscapor" value="1" />
                                        <span></span>
                                        Clave Elector
                                    </label>
                                    <label class="radio radio-outline radio-success">
                                        <input type="radio" name="buscapor" value="1" />
                                        <span></span>
                                        Nombre
                                    </label>
                                </div>
                            </div> -->
                            <div class="col-sm-3 col-xs-12">
                                <label>Buscar por: CURP ó Nombre</label>
                                <select class="custom-select form-control" style="line-height: 36px !important;height: 36px !important;" id="busca_persona" >
                                </select>
                            </div>

                            <div class="col-sm-3 col-xs-12" id="columna1" style="display:none;">
                              <label>Responsabilidad </label>
                              <select class="custom-select form-control w100" id="cve_t_responsabilidad" name="cve_t_responsabilidad">
                                  @isset($responsabilidades)
                                  @foreach($responsabilidades as $key => $value)
                                    <option value="{{$value->cve_cat_responsabilidad}}">
                                        {{$value->responsabilidad}}
                                    </option>
                                  @endforeach
                                  @endisset
                              </select>
                            </div>
                            <div class="col-sm-3 col-xs-8" id="columna2" style="display:none;">
                                <label>Titular</label>
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-success">
                                        <input type="checkbox" id="id_titular" />
                                        <span></span>
                                        Es titular del nivel
                                    </label>
                                </div>
                            </div>


                            <div class="col-sm-3 col-form-label" style="margin-top: 16px;">
                                <div style="display: none;" id="divRegistra">
                                    <a href="/registro/create" class="btn btn-primary w100">
                                        <i class="fas fa-user"></i>
                                        Registrar persona
                                    </a>
                                </div>

                                <div style="display: none;" id="divGuarda">
                                    <button id="btnGuarda" class="btn btn-primary w100">
                                        @isset($responsable)
                                        <i class="fas fa-user"></i>
                                        Actualizar
                                        @else
                                        <i class="fas fa-user-plus"></i>
                                        Agrega
                                        @endisset
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- fin row -->
                    <br />
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="/estructuras" class="btn btn-secondary">
                                <i class="flaticon2-back"></i> Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <!-- fin card-footer -->
            </div>
        </form>

    </div>
    <!--end::Card-->

    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon-users text-primary"></i></span>
                <h3 class="card-label">Responsables registrados en la estructura seleccionada </h3>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-body pb-1" style="padding: 1rem 2.25rem !important;">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" >
                    <thead>
                        <tr role="row">
                            <th style="width: 30%;">Nombre del responsable </th>
                            <th style="width: 18%;">Responsabilidad </th>
                            <th style="width: 16%;">CURP </th>
                            <th style="width: 18%;">Clave Elector </th>
                            <th style="width: 8%;">Titular </th>
                            <th style="width: 10%;">Acciones </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!--end::Card-->

    @include('estructuras::comun.comun')
@endsection

@section('script')
    <!--begin::Page Vendors(used by this page)-->
    <script src="/metronic/assets/js/pages/features/miscellaneous/sweetalert2.js?v=7.0.6"></script>
    <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
    <!--end::Page Vendors-->

    @yield('script.comun')
    <script>
        let estructura_nivel = @JSON($estructura_nivel);

        $(function() {
            $("#cve_t_responsabilidad").select2({ minimumResultsForSearch: 10 });
            $("#busca_persona").select2({ minimumResultsForSearch: 10 });

            llenaTabla(estructura_nivel);

/*
            $("input[type='radio']").click(function(e) {
                let valor = $("input[type='radio']:checked").val();
                if(valor == 0)
                    $('#lblBusca').html('CURP');
                if(valor == 1)
                    $('#lblBusca').html('Nombre de la persona');
            });
*/
            $('#busca_persona').select2({
                ajax: {
                    url: '/estructuras/buscaPersona',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: params.term,
                            tipo: 1 // $("input[type='radio']:checked").val()
                        }
                    },
                    processResults: function (data) {
/*
                        if (data.length == 0) {
                            $('#columna1').hide();
                            $('#columna2').hide();

                            $('#divGuarda').hide();
                            $('#divRegistra').show();
                        }
                        else {
                            $('#columna1').show();
                            $('#columna2').show();

                            $('#divRegistra').hide();
                            $('#divGuarda').show();
                        }
*/
                        return {
                            results: data
                        }
                    }
                },
                minimumInputLength: 3,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });


            function formatRepo (repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                            "<div class='bold'>" +
                                "<div class='select2-result-repository__nombre'></div>" +
                            "</div>" +
                            "<div class='select2-result-repository__curp'></div>" +
                            "<div class='select2-result-repository__clave'></div>" +
                        "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__nombre").text(repo.text);
                $container.find(".select2-result-repository__curp").text(repo.curp);
                $container.find(".select2-result-repository__clave").text(repo.clave);
                return $container;
            }

            function formatRepoSelection (repo) {
                return repo.text || repo.curp;
            }

            $('#busca_persona').change(function() {
                let valor = $('#busca_persona option:selected').text();
                if (valor != '') {
                    $('#columna1').show();
                    $('#columna2').show();

                    $('#divRegistra').hide();
                    $('#divGuarda').show();
                }
                else {
                    $('#columna1').hide();
                    $('#columna2').hide();

                    $('#divRegistra').show();
                    $('#divGuarda').hide();
                }
            });


            $('#btnGuarda').click(function(e) {
                e.preventDefault();
                let ruta = '/estructuras/responsables';
                @isset($responsable)
                    ruta += '/update/' +id_responsable;
                @else
                    ruta += '/store';
                @endisset


                let id_titular = $("input[type='checkbox']:checked").val();
                id_titular  = (id_titular == 'on') ? 1 : 0;
                let form        = document.getElementById("formResponsables");
                let formData    = new FormData (form);
                formData.append('cve_t_estructura_nivel', estructura_nivel);
                formData.append('cve_t_ciudadano', $('#busca_persona').val());
                formData.append('id_titular', id_titular);

                $.ajax({
                    url: ruta,
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(r) {
                        muestra_notificacion (r);
                        llenaTabla(estructura_nivel);

                        // limpia
                        $('#busca_persona').val(null).trigger('change');
                        $('#id_responsabilidad').val(0);
                        $('#id_titular').prop('checked', false);
                    }
                });
            });
        });

        function llenaTabla(id) {
            if ( $.fn.DataTable.isDataTable('#kt_datatable') ) {
                $('#kt_datatable').DataTable().destroy();
            }

            tabla = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: {
                    url: "/estructuras/responsables/tabla/" +id,
                },
                columns: [
                    { data: 'cve_t_ciudadano', name: 'cve_t_ciudadano' },
                    { data: 'cve_t_responsabilidad', name: 'cve_t_responsabilidad' },
                    { data: 'curp', name: 'curp' },
                    { data: 'clave', name: 'clave' },
                    { data: 'id_titular', name: 'id_titular', searchable: false, orderable: false },
                    { data: 'acciones', name: 'acciones', searchable: false, orderable: false, class: 'acciones' }
                ],
                columnDefs: [
                    { render: function (data, type, row) {
                        columna = data;
                        return columna;
                    }, targets: [0] },
                    { render: function (data, type, row) {
                        return data;
                    }, targets: [2] },
                    { render: function (data, type, row) {
                        columna = (data == 1) ? '<span style="margin-left:12px;"><i class="fa fa-medal"></i></span>' : '';
                        return columna;
                    }, targets: [4] }
                ],
                createdRow: function ( row, data, index ) {
                    $(row).find('.ui.dropdown.acciones').dropdown();
                },
                language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
            });

        }
    </script>
@endsection
