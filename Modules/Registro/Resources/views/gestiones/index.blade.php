@extends('layouts.index')
@section('titulo', 'Gestiones')
@section('acciones', '')
@section('breadcumb', 'Todas las Gestiones')
@section('style')
  <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <style>
  .select2-container { width: 100% !important; }
  .w100 { width: 100%;}
  </style>
@endsection
@section('content')

 <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
        <h3 class="card-label">Todas las Gestiones</h3>
      </div>
      <div class="card-toolbar">
        <!--begin::Button-->


        <a href="/gestiones/create" class="btn btn-primary font-weight-bolder">
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
        </a>

        <!--end::Button-->
      </div>
    </div>
    <div class="card-body">
      <div class="dataTables_scroll">

        <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh;">
          <!--begin: Datatable-->
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important" >
            <thead>
              <tr>
                <th>Beneficiario </th>
                <th>Representante</th>
                <th>Fecha Registro</th>
                <th>Origen</th>
                <th>Tipo Petición</th>
                <th>Categoria</th>
                <th>Municipio</th>
                <th>Gestor</th>
                <th>Fecha Atendio</th>
                <th>Apoyo Otorgado</th>
                <th>Estatus</th>
                <!--<th>Estructura</th>-->
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
          <!--end: Datatable-->
        </div>
      </div>

    </div>
  </div>

  <!-- Modal-->
  <div class="modal fade" id="estatus_gestiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Actualizar Estatus</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                        <label>Estatus </label>
                        <select class="form-control" id="estatus">
                          <option value="0">Selecciona un estatus</option>
                          <option value="2">Entregada</option>
                          <option value="3">En Proceso</option>
                          <option value="4">Pendiente</option>
                          <option value="5">Cancelada</option>
                      </select>
                    </div>
                </div>

                <div class="row entregas">
                  <div class="col-sm-6 col-xs-12 form-group">
                      <label>Fecha Atendido</label>
                      <input type="date" class="form-control" placeholder="Fecha Atendido" name="curp" id="fecha_atendido" >
                  </div>


                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Fecha Entregada</label>
                    <div class="input-group">
                      <input type="date" class="form-control" placeholder="Fecha Entregada" name="clave_elector"  id="fecha_entregada" >
                    </div>
                  </div>

                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Apoyo Otorgado</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Apoyo Otorgado"  id="apoyo_otorgado" >
                    </div>
                  </div>

                </div>



                <div class="row">
                  <div class="col-sm-12 col-xs-12 form-group">
                      <label>Comentario </label>
                      <textarea type="text" class="form-control" id="descripcion_estatus"></textarea>

                  </div>
                  <div id="id_gest"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-light-primary font-weight-bold btn-submit" >Actualizar</button>
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
        url: "/gestiones/tabla",
      },
      columns: [
        { data: 'cve_t_ciudadano', name: 'cve_t_ciudadano' },
        { data: 'representante', name: 'representante' },
        { data: 'fecha_recepcion', name: 'fecha_recepcion' },
        { data: 'origen_peticion', name: 'origen_peticion' },
        { data: 'tipo_peticion', name: 'tipo_peticion' },
        { data: 'categoria_peticion', name: 'categoria_peticion' },
        { data: 'municipio', name: 'municipio' },
        { data: 'gestor', name: 'gestor' },
        { data: 'fecha_atendido', name: 'fecha_atendido' },
        { data: 'apoyo_otorgado', name: 'apoyo_otorgado' },

        { data: 'estatus', name: 'estatus' },
        { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  });

  ////////////////////// ELIMINAR /////////////////////////////////////////////
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

                   url:"/gestiones/Eliminar",
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
  ///////////////////////////////// FUNCIONES MODAL //////////////////////////////////////

      $('.entregas').hide();

      $("#estatus").change(function(){

        var tipo_peticion = $("#estatus").val();

          if(tipo_peticion == 2){
              $('.entregas').show();
          } else {
              $('.entregas').hide();
          }

      });

  //////////////////////////////////////////// ESTATUS GESTIONES ////////////////////////
  function estatus(id){

    $('#estatus_gestiones').modal('show');

    $('#id_gest').html('<input type="hidden" value="'+id+'" id="id_gestion"/>');


  }
  //////////////////////////////////////////////////////////////////////////////
  	$(document).ready( function () {
      $(".btn-submit").click(function(e){


         e.preventDefault();



          var estatus = $("#estatus").val();
          var fecha_atendido = $("#fecha_atendido").val();
          var fecha_entregada = $("#fecha_entregada").val();
          var apoyo_otorgado = $("#apoyo_otorgado").val();
          var descripcion_estatus = $("#descripcion_estatus").val();
          var id_gestion =  $("#id_gestion").val();




           $.ajax({

              type:"POST",

              url:"/gestiones/Estatus",
              headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data:{
                estatus:estatus,
                fecha_atendido:fecha_atendido,
                fecha_entregada:fecha_entregada,
                apoyo_otorgado:apoyo_otorgado,
                descripcion_estatus:descripcion_estatus,
                id_gestion:id_gestion

              },

               success:function(data){
                 Swal.fire("Excelente!", data.success, "success").then(function(){

                   $('#estatus_gestiones').modal('hide');
                   var estatus = $("#estatus").val(0);
                   $('.entregas').hide();
                   var fecha_atendido = $("#fecha_atendido").val('');
                   var fecha_entregada = $("#fecha_entregada").val('');
                   var apoyo_otorgado = $("#apoyo_otorgado").val('');
                   var descripcion_estatus = $("#descripcion_estatus").val('');

                   tabla.ajax.reload();

                 });
                   //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
               }


           });
         });
    });
</script>
@endsection
