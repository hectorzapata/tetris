@extends('layouts.index')
@section('titulo', 'App Movil')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item"><span class="text-muted">Todos los registros</span> </li>
@endsection
@section('style')
  <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="flaticon2-browser text-primary"></i></span>
        <h3 class="card-label">Todos los registros</h3>
      </div>
      <div class="card-toolbar">
        <!--begin::Button-->
        {{-- <a href="/usuarios/create" class="btn btn-primary font-weight-bolder">
          <span class="svg-icon svg-icon-md">
            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>
          Nuevo
        </a> --}}
        <!--end::Button-->
      </div>
    </div>
    <div class="card-body">
      @include('flash::message')
      <!--begin: Datatable-->
      <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
        <thead>
          <tr>
            <th>Capturado por</th>
            <th>Nombre</th>
            <th>Clave Elector</th>
            <th>Sección</th>
            <th>CURP</th>
            <th>Teléfono</th>
            <th>Domicilio</th>
            <th>Municipio</th>
            <th>Acciones</th>
          </tr>
        </thead>
      </table>
      <!--end: Datatable-->
    </div>
  </div>
  <!--end::Card-->
@endsection
@section('script')
  <!--begin::Page Vendors(used by this page)-->
  <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
  <!--end::Page Vendors-->
  <script>
  var tabla;
  $(function() {
    tabla = $('#kt_datatable').DataTable({
      processing: true,
      serverSide: true,
      order: [[0, 'desc']],
      ajax: {
        url: "/appmovil/tabla",
      },
      scrollX: true,
      columns: [
        { data: 'obt_usuario.username', name: 'obtUsuario.username' },
        {
          data: 'nombre',
          name: 'nombre',
          render: function ( data, type, row ) {
            return data ? ( data.length > 30 ? data.substr( 0, 30 ) + "..." : data ) : "";
          }
        },
        { data: 'clave', name: 'clave' },
        { data: 'seccion', name: 'seccion' },
        { data: 'curp', name: 'curp'  },
        { data: 'tel', name: 'tel'  },
        { data: 'domicilio', name: 'domicilio' ,
          render: function ( data, type, row ) {
            return data ? ( data.length > 30 ? data.substr( 0, 30 ) + "..." : data ) : "";
          }
        },
        { data: 'municipio', name: 'municipio' },
        { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  });
  function eliminar(id){
    var id_registro = id;
    Swal.fire({
      title: "¿Estas seguro?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "¡Si, bórralo!"
    }).then(function(result) {
      if (result.value) {
        $.ajax({
          type:"DELETE",
          url:"/appmovil/Eliminar",
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data:{ id_registro:id_registro, },
          success:function(data){
            Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); });
          }
        });
      }
    });
  }
  </script>
@endsection
