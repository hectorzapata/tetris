@extends('layouts.index')
@section('titulo', 'Consulta Gestiones')
@section('acciones', '')
@section('breadcumb', 'Todos las Consultas Gestión')
@section('style')
  <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
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
      <h3 class="card-label">Consulta Gestiones</h3>
    </div>
    <div class="card-toolbar">

    </div>
  </div>
  <div class="card-body">
    <div class="row">

        <div class="col-sm-4 col-xs-12 form-group">
          <label>Estructura</label>
          <div></div>
          <select class=" form-control" name="" id="estructura_id">
            <option value="0">Selecciona una Estructura</option>
            @foreach($registro as $res)
            <option value="{{ $res->cve_t_registro_ciudadano }}">{{ $res->nombre_estructura }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-4 col-xs-12 form-group">
          <label>Municipio</label>
          <div></div>
          <select class=" form-control" name="filtros" id="municipio_id">
            <option value="0">Selecciona un Municipio</option>
            @foreach($municipio as $mun)
            <option value="{{ $mun->id }}">{{ $mun->valor }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-sm-4 col-xs-12 form-group">
          <label>Tipo Petición</label>
          <div></div>
          <select class=" form-control" name="filtros" id="tipo_peticion_id">
            <option value="0">Selecciona una Petición</option>
            <option value="1">Individual</option>
            <option value="2">Grupal</option>
          </select>
        </div>

        <div class="col-sm-4 col-xs-12 form-group">
          <label>Estatus</label>
          <div></div>
          <select class=" form-control" name="estatus_id" id="estatus_id">
            <option value="0">Selecciona un Estatus</option>
            <option value="1">Registrado</option>
            <option value="2">Entregada</option>
            <option value="3">En Proceso</option>
            <option value="4">Pendiente</option>
            <option value="5">Cancelada</option>

          </select>

          <div style="height:25px;"></div>
          <a href="javascript:gestiones()" class="btn btn-primary">filtrar</a>
        </div>

        <div class="col-sm-4 col-xs-12 form-group">
          <label>Rango de fechas de recepción</label>
          <div></div>
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-group">
              <input type="date" class="form-control" placeholder="Fecha Recepción" name="curp" value="@isset($gestiones){{ $gestiones->fecha_recepcion }}@endisset" id="fecha_recepcion_1" >
            </div>
            <div class="col-sm-6 col-xs-12 form-group">
              <input type="date" class="form-control" placeholder="Fecha Recepción" name="curp" value="@isset($gestiones){{ $gestiones->fecha_recepcion }}@endisset" id="fecha_recepcion_2" >
            </div>
          </div>
        </div>

        <div class="col-sm-4 col-xs-12 form-group existeestatus2" style="display: none;">
          <label>Rango de fecha de entregas</label>
          <div></div>
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-group">
              <input type="date" class="form-control" placeholder="Fecha Recepción" name="curp" value="@isset($gestiones){{ $gestiones->fecha_recepcion }}@endisset" id="fecha_entrega_1" >
            </div>
            <div class="col-sm-6 col-xs-12 form-group">
              <input type="date" class="form-control" placeholder="Fecha Recepción" name="curp" value="@isset($gestiones){{ $gestiones->fecha_recepcion }}@endisset" id="fecha_entrega_2" >
            </div>
          </div>


        </div>



    </div>

    <!--///// TABLA ////////////////////////-->

    <div class="row  tabla" style="display: none;">
      <div class="separator separator-dashed mt-8 mb-5"></div>
      <div class="dataTables_scroll">

        <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh;">
          <table class="table table-separate table-head-custom table-checkable dataTable no-footer" role="grid" style="margin-left: 0px; width: 1146.35px;" id="kt_datatable" >
            <thead>
              <tr>
                <th>Fecha Recepción</th>
                <th>Tipo Petición</th>
                <th>Tipo Apoyo</th>
                <th>Descripción Apoyo</th>
                <th>Gestor</th>
                <th>Municipio</th>
                <th>Fecha Atendio</th>
                <th>Apoyo Otorgado</th>
                <th>Estatus</th>

                 <th>Acciones</th>
                <!--<th>Nombre Estructura</th> -->
              </tr>
            </thead>
            <tbody >
            </tbody>
          </table>
        </div>
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

<!-- Modal GRUPO-->
<div class="modal fade" id="grupo_gestiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestiones en Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="dataTables_scroll">

                <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh;">
                  <table class="table table-bordered table-hover table-checkable" id="tablaGrupos" style="margin-top: 13px !important" >
                    <thead>
                           <tr>

                               <th scope="col">Nombre Beneficiario</th>
                               <th scope="col">RFC</th>
                               <th scope="col">CURP</th>
                               <!-- <th scope="col">EDAD</th> -->
                               <th scope="col">MUNICIPIO</th>
                               <th scope="col">COLONIA</th>
                               <th scope="col">C.P</th>
                           </tr>
                       </thead>
                       <tbody>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Bene-->
<div class="modal fade" id="beneficiario_gestiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestion Beneficiario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="dataTables_scroll">

                <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh;">
                  <table class="table table-bordered table-hover table-checkable" id="tablaBeneficiario" style="margin-top: 13px !important" >
                    <thead>
                           <tr>

                               <th scope="col">Nombre Beneficiario</th>
                               <th scope="col">RFC</th>
                               <th scope="col">CURP</th>
                               <!-- <th scope="col">EDAD</th> -->
                               <th scope="col">MUNICIPIO</th>
                               <th scope="col">COLONIA</th>
                               <th scope="col">C.P</th>
                           </tr>
                       </thead>
                       <tbody>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
$('.tabla').hide();
var tablaPersonas = '';
function gestiones(){

  var estructura_id = $('#estructura_id').val();
  var municipio_id = $('#municipio_id').val();
  var tipo_peticion_id = $('#tipo_peticion_id').val();
  var estatus_id = $('#estatus_id').val();
  var fecha_recepcion_1 = $('#fecha_recepcion_1').val();
  var fecha_recepcion_2 = $('#fecha_recepcion_2').val();
  var fecha_entrega_1 = $('#fecha_entrega_1').val();
  var fecha_entrega_2 = $('#fecha_entrega_2').val();

  if (estructura_id == 0 || municipio_id == 0 || tipo_peticion_id == 0 || estatus_id == 0 || fecha_recepcion_1 == 0 || fecha_recepcion_2 == 0 ) {
    Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
  }else{
    $('.tabla').show();
    tablaPersonas = $('#kt_datatable').DataTable({
      dom: 'Bfrtip',
      buttons: [ {
        extend: 'excelHtml5',
        autoFilter: true,
        sheetName: 'Datos Gestiones',
        title: 'Datos Gestiones'
    } ],
      processing: true,
      serverSide: true,
      stateSave: true,
      "bDestroy": true,
      ajax:{
          'type': 'GET',
          'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
          'url' : '/consulta_gestiones/traerTablaGestion',
          'data':{  estructura_id: $('#estructura_id').val(),
                    municipio_id: $('#municipio_id').val(),
                    tipo_peticion_id: $('#tipo_peticion_id').val(),
                    estatus_id: $('#estatus_id').val(),
                    fecha_recepcion_1: $('#fecha_recepcion_1').val(),
                    fecha_recepcion_2: $('#fecha_recepcion_2').val(),
                    fecha_entrega_1: $('#fecha_entrega_1').val(),
                    fecha_entrega_2: $('#fecha_entrega_2').val()  }
      },
      columns: [
        { data: 'fecha_recepcion', name: 'fecha_recepcion' },
        { data: 'tipo_peticion', name: 'tipo_peticion' },
        { data: 'categoria_peticion', name: 'categoria_peticion' },


        { data: 'descripcion_gestor', name: 'descripcion_gestor' },
        { data: 'gestor', name: 'gestor' },


        { data: 'municipio', name: 'municipio' },
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
  }

}


$("select[name=estatus_id]").change(function(){

  var filtro = $("select[name=estatus_id]").val();

  if (filtro == 2) {

    $('.existeestatus2').show();


  }else{
    $('.existeestatus2').hide();
    $('#fecha_entrega_1').val('');
    $('#fecha_entrega_2').val('');


  }



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

                 url:"/consulta_gestiones/Eliminar",
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

            url:"/consulta_gestiones/Estatus",
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

                 tablaPersonas.ajax.reload();

               });
                 //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
             }


         });
       });
  });
  ////////////////////////////////////////////BENEFICIARIO GESTION /////////////////////////
  function beneficiario(id){
    $('#beneficiario_gestiones').modal('show');
    tablaBeneficiario = $('#tablaBeneficiario').DataTable({
      dom: 'Bfrtip',
      buttons: [ {
        extend: 'excelHtml5',
        autoFilter: true,
        sheetName: 'Datos Gestion Beneficiario',
        title: 'Datos Gestion Beneficiario'
    } ],
      processing: true,
      serverSide: true,
      stateSave: true,
      "bDestroy": true,
      ajax:{
          'type': 'GET',
          'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
          'url' : '/consulta_gestiones/beneficiario',
          'data':{ id: id }
      },
      columns: [
        { data: 'nombre', name: 'nombre' },
        { data: 'rfc', name: 'rfc' },
        { data: 'curp', name: 'curp' },

        { data: 'municipio', name: 'municipio' },
        { data: 'colonia', name: 'colonia' },
        { data: 'cp', name: 'cp' },

        //{ data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  }
  //////////////////////////////////////////// GRUPO GESTIONES ////////////////////////
  function grupo(id){

    $('#grupo_gestiones').modal('show');

    tablaGestion = $('#tablaGrupos').DataTable({
      dom: 'Bfrtip',
      buttons: [ {
        extend: 'excelHtml5',
        autoFilter: true,
        sheetName: 'Datos Gestiones Grupos',
        title: 'Datos Gestiones Grupos'
    } ],
      processing: true,
      serverSide: true,
      stateSave: true,
      "bDestroy": true,
      ajax:{
          'type': 'GET',
          'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
          'url' : '/consulta_gestiones/gestiones',
          'data':{ id: id }
      },
      columns: [
        { data: 'nombre', name: 'nombre' },
        { data: 'rfc', name: 'rfc' },
        { data: 'curp', name: 'curp' },

        { data: 'municipio', name: 'municipio' },
        { data: 'colonia', name: 'colonia' },
        { data: 'cp', name: 'cp' },

        //{ data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });


  }



</script>

@endsection
