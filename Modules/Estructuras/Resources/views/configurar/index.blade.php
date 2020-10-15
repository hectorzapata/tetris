@extends('layouts.index')
@section('titulo', 'Configurar estructura')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item"><span class="text-muted">Todas las estructuras</span> </li>
@endsection
@section('style')
    <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <style>
        .derecha { text-align: right; }
        .blanco { background-color: white !important; }
        .table th, .table td { padding: .5rem 0.75rem !important; }
        .dataTables_wrapper table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child:before { content: none !important; }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-gear text-primary"></i></span>
                        <h3 class="card-label">Todas las Estructuras configuradas</h3>
                    </div>

                    <div class="card-toolbar">
                        @if(permiso('02', 'Crear') || 1 == 1)
                        <a href="configurar/create" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                    <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            Nueva
                        </a>
                        @endif

                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                        <thead>
                            <tr role="row">
                                <th style="width: 8%;">Niveles </th>
                                <th style="width: 30%;">Nombre de Estructura</th>
                                <th style="width: 44%;">Descripción</th>
                                <th style="width: 8%;">DF</th>
                                <th style="width: 10%;">Acciones</th>
                            </tr>
                        </thead>
                    </table>

                </div>  <!-- fin: card-body -->
            </div>  <!-- fin: card -->
        </div>
    </div>

    @include('estructuras::comun.comun')
@endsection

@section('script')
    <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>

    <script>
        var tabla;

        $(function() {
            tabla = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: {
                    url: "/estructuras/configurar/tabla",
                },
                columns: [
                    {
                        data: 'tiene_niveles', name: 'tiene_niveles',
                        class: 'details-control', data: null,
                        defaultContent: '', searchable: false, orderable: false, width: '30px'
                    },
                    { data: 'nombre_estructura', name: 'nombre_estructura' },
                    { data: 'descripcion', name: 'descripcion' },
                    { data: 'distrito_federal', name: 'distrito_federal' },
                    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, class: 'acciones' }
                ],
                columnDefs: [
                    { render: function (data, type, row) {
                        columna = (data.tiene_niveles) ? '<a href="#" class="font-weight-bold pl-6"><i class="flaticon-layer text-primary"> </i>  </a>' : '';
                        return columna;
                    }, targets: [0] }
                ],
                createdRow: function ( row, data, index ) {
                    $(row).find('.ui.dropdown.acciones').dropdown();
                },
                language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
            });



            // Add event listener for opening and closing details
            $('#kt_datatable tbody').on('click', 'td.details-control', function () {
                var tr  = $(this).closest('tr');
                var row = tabla.row( tr );

                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    if (row.data) {
                        d = row.data();

                        $.ajax({
                            url:  '/estructuras/lista_niveles/' + d.id_estructura +'/1',
                            headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                            type: 'GET'
                        })
                        .always(function(r) {
                            if (r) {
                                row.child( r ).show();
                                tr.addClass('shown');
                            }
                        });
                    }
                }
            });
        });

        function eliminar(id) {
            $('#modalElimina').modal({
                blurring: true,
                closable: false,
                onApprove: function() {
                    $('#btnElimina').addClass('loading');
                    $.ajax({
                        url: '/estructuras/configurar/' +id,
                        headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                        type: 'delete'
                    })
                    .always(function(r) {
                        $('#btnElimina').removeClass('loading');
                        if (r.exito) {
                            tabla.ajax.reload();
                        }
                    });
                }
            }).modal('show');
        }

        function eliminar_nivel(id) {
            $('#modalElimina').modal({
                blurring: true,
                closable: false,
                onApprove: function() {
                    $('#btnElimina').addClass('loading');
                    $.ajax({
                        url: '/estructuras/configurar/niveles/' +id,
                        headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                        type: 'delete'
                    })
                    .always(function(r) {
                        $('#btnElimina').removeClass('loading');
                        if (r.exito) {
                            tabla.ajax.reload();
                        }
                    });
                }
            }).modal('show');
        }

    </script>
    @yield('script.comun')

@endsection
