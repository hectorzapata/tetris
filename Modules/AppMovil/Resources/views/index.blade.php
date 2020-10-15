@extends('layouts.index')
@section('titulo', 'App Movil')
@section('acciones', '')
@section('breadcumb', 'Todos los Registros INE')
@section('style')
  <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
        <h3 class="card-label">Todos los Registros INE</h3>
      </div>
      <div class="card-toolbar">

      </div>
    </div>
    <div class="card-body">
      <div class="dataTables_scroll">

        <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh;">
          <!--begin: Datatable-->
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>Nombre </th>
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

    </div>
  </div>
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
      columns: [
        { data: 'nombre', name: 'nombre' },
        { data: 'clave', name: 'clave' },
        { data: 'seccion', name: 'seccion' },

        { data: 'curp', name: 'curp' },
        { data: 'tel', name: 'tel' },
        { data: 'domicilio', name: 'domicilio' },
        { data: 'municipio', name: 'municipio' },
        { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  });

  ///////////////// ELIMINAR //////////////////////////////////////////
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
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                     id_registro:id_registro,
                   },

                    success:function(data){
                      Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); });

                    }


                });


          }
      })



  }

  </script>
@endsection
