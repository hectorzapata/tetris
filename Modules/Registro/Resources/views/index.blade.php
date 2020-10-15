@extends('layouts.index')
@section('titulo', 'Registros')
@section('acciones', '')
@section('breadcumb', 'Todos los Registros')
@section('style')
  <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <style>
  .select2-container { width: 100% !important; }
  .w100 { width: 100%;}
  </style>
@endsection
@section('content')
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
        <h3 class="card-label">Todos los Registros</h3>
      </div>
      <div class="card-toolbar">
        <!--begin::Button-->


        <a href="/registro/create" class="btn btn-primary font-weight-bolder">
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
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>Nombre </th>
                <th>Domicilio</th>
                <th>Colonia</th>
                <th>Municipio</th>
                <!--<th>Telefono Fijo</th>
                <th>Telefono Cel.</th>-->
                <th>Apoyos</th>
                <th>Nombre Estructura</th>
                <th>Fecha Registro</th>
                <th>Estatus</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
          <!--end: Datatable-->
        </div>
    </div>
    </div>
  </div>
  <!--end::Card-->

  <!-- Modal-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Gestiones</h5>
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
                                 <!-- <th scope="col">Representante</th> -->
                                 <th scope="col">Colonia</th>
                                 <th scope="col">Municipio</th>
                                 <!-- <th scope="col">Telefono</th> -->
                                 <th scope="col">Telefono Cel.</th>
                                 <th scope="col">Apoyo</th>
                                 <th scope="col">Estructura</th>
                                 <th scope="col">Fecha de Registro</th>
                                 <th scope="col">Petición</th>
                                 <th scope="col">Estatus</th>
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
  <!-- Modal Suspender-->
  <div class="modal fade" id="suspender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Suspender Registro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                      <label>CURP</label>
                      <div id="curp_existe">

                      </div>
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                      <label>RFC</label>
                      <div id="rfc_existe">

                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Pertenece a</label>
                  </div>
                </div>
                <div class="row">

                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Responsable</label>
                      <div id="responsable">

                      </div>
                    </div>

                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Estructura</label>
                      <div id="estructura">

                      </div>
                    </div>

                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Fecha de alta Registro</label>
                      <div id="fecha">

                      </div>
                    </div>
                </div>
              </div>
              <div class="form-group col-xs-12 col-sm-12">
                <label>Motivo</label>
                <textarea class="form-control" name="motivo" ></textarea>
              </div>
              <div id="id"></div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary btn-submit" data-dismiss="modal">Suspender</button>

              </div>
          </div>
      </div>
  </div>
  <!-- Modal Activar-->
  <div class="modal fade" id="activar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Activar Registro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 form-group">
                      <label>CURP</label>
                      <div id="curp_existe_activar"></div>
                    </div>

                    <div class="col-sm-6 col-xs-12 form-group">
                      <label>RFC</label>
                      <div id="rfc_existe_activar"></div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Pertenece a</label>
                  </div>
                </div>
                <div class="row">

                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Responsable</label>
                      <div id="responsable_activar"></div>
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Estructura</label>
                      <div id="estructura_activar"></div>
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Fecha de alta Registro</label>
                      <div id="fecha_activar"></div>
                    </div>
                </div>
              </div>
              <div class="form-group col-xs-12 col-sm-12">
                <label>Motivo</label>
                <div id="motivo_activar"></div>
              </div>

              <div id="id_activar"></div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary btn-submit_activar" data-dismiss="modal">Activar</button>

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
        url: "/registro/tabla",
      },
      columns: [
        { data: 'nombre', name: 'nombre' },
        { data: 'calle_domicilio', name: 'calle_domicilio' },
        { data: 'nombre_asentamiento', name: 'nombre_asentamiento' },

        { data: 'cve_mun', name: 'cve_mun' },

        { data: 'apoyo', name: 'apoyo' },





        { data: 'nombre_estructura', name: 'nombre_estructura' },

        { data: 'fecha_registro', name: 'fecha_registro' },


        { data: 'estatus', name: 'estatus' },
        { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  });
  ////////////////////////// Activar ///////////////////////////////////
  function activar(id){
    var id_activar = id;
    $('#activar').modal('show');
    $.ajax({

       type:"GET",

       url:"/registro/Activar",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         id:id,
       },

        success:function(data){




            var  curp_existe_activar = data.curp;
            var  rfc_existe_activar = data.rfc;
            var  fecha_activar = data.fecha;
            var  responsable_activar = data.responsable;
            var  estructura_activar = data.estructura;
            var  motivo_activar = data.motivo;

            $('#curp_existe_activar').html('<p>'+curp_existe_activar+'</p>');
            $('#rfc_existe_activar').html('<p>'+rfc_existe_activar+'</p>');
            $('#fecha_activar').html('<p>'+fecha_activar+'</p>');
            $('#responsable_activar').html('<p>'+responsable_activar+'</p>');
            $('#estructura_activar').html('<p>'+estructura_activar+'</p>');
            $('#motivo_activar').html('<p>'+motivo_activar+'</p>');
            $('#id_activar').html('<input type="hidden" value="'+id_activar+'" name="id_activar"/>');



            $('#modal').modal('show');



        }


    });
  }
  ///////////////// ELIMINAR //////////////////////////////////////////
  function eliminar(id){

    var id_user = id;
    $('#suspender').modal('show');

    $.ajax({

       type:"GET",

       url:"/registro/Suspender",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         id:id,
       },

        success:function(data){




            var  curp_existe = data.curp;
            var  rfc_existe = data.rfc;
            var  fecha = data.fecha;
            var  responsable = data.responsable;
            var  estructura = data.estructura;

            $('#curp_existe').html('<p>'+curp_existe+'</p>');
            $('#rfc_existe').html('<p>'+rfc_existe+'</p>');
            $('#fecha').html('<p>'+fecha+'</p>');
            $('#responsable').html('<p>'+responsable+'</p>');
            $('#estructura').html('<p>'+estructura+'</p>');
            $('#id').html('<input type="hidden" value="'+id+'" name="id"/>');



            $('#modal').modal('show');



        }


    });
  }
  //////////////////////////////////////////// GESTIONES ////////////////////////
  function verGestion(id){

    $('#exampleModal').modal('show');
    console.log(id);
    $.ajax({

       type:"GET",

       url:"/registro/gestiones",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         id_user:id,
       },

        success:function(data){

          //console.log(data.cve_t_ciudadano);

          data.forEach((x) => {
//console.log(x.cve_t_ciudadano);
            var id = x.cve_t_ciudadano;
          });

          tabla = $('#tablaGrupos').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            stateSave: true,
            "bDestroy": true,
            ajax: {
              url: "/registro/tablaGestion/"+id,
            },
            columns: [
              { data: 'nombre', name: 'nombre' },
              //{ data: 'estatus', name: 'estatus' },
              { data: 'calle_domicilio', name: 'calle_domicilio' },


              { data: 'municipio', name: 'municipio' },

              // { data: 'estatus', name: 'estatus' },

              { data: 'numero_telefono', name: 'numero_telefono' },

              { data: 'apoyo_otorgado', name: 'apoyo_otorgado' },


              { data: 'nombre_estructura', name: 'nombre_estructura' },
              { data: 'fecha_recepcion', name: 'fecha_recepcion' },

              { data: 'tipo_peticion', name: 'tipo_peticion' },

              { data: 'estatus', name: 'estatus' },
            ],
            createdRow: function ( row, data, index ) {
              $(row).find('.ui.dropdown.acciones').dropdown();
            },
            language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
          });


          // if (data == 0) {
          //   tr = '<tr>'+
          //   '<td colspan="10" style="text-align:center;"><strong>Sin Gestiones Atribuidas</strong></td>'+
          //
          //   '</tr>';
          //   $("#tablaGrupos").append(tr);
          //   //$("#tablaGrupos").empty().append(tr);
          //
          // }else{
          //   tr = '<thead>'+
          //       '<tr>'+
          //
          //           '<th scope="col">Nombre Beneficiario</th>'+
          //           '<th scope="col">Representante</th>'+
          //           '<th scope="col">Colonia</th>'+
          //           '<th scope="col">Municipio</th>'+
          //           '<th scope="col">Telefono</th>'+
          //           '<th scope="col">Telefono Cel.</th>'+
          //           '<th scope="col">Apoyo</th>'+
          //           '<th scope="col">Estructura</th>'+
          //           '<th scope="col">Fecha de Registro</th>'+
          //           '<th scope="col">Estatus</th>'+
          //       '</tr>'+
          //   '</thead>'+
          //   '<tbody>'+
          //
          //   data.forEach((x) => {
          //
          //     var estatus = '';
          //     if (x.estatus == 1) {
          //       estatus = 'Individual';
          //     }else{
          //       estatus = 'Grupal';
          //     }
          //
          //     '<tr>'+
          //     '<td>'+ x.nombre +' '+x.paterno +' '+x.materno +'</td>'+
          //     '<td></td>'+
          //     '<td>Calle: '+ x.calle_domicilio +', #'+x.num_ext +', C.P: '+x.cp +'</td>'+
          //     '<td>'+ x.municipio +'</td>'+
          //     '<td></td>'+
          //     '<td>'+ x.numero_telefono +'</td>'+
          //     '<td>'+ x.apoyo_otorgado +'</td>'+
          //     '<td>'+ x.nombre_estructura +'</td>'+
          //     '<td>'+ x.fecha_recepcion +'</td>'+
          //     '<td>'+ estatus +'</td>'+
          //     '</tr>'
          //
          //
          //     //$("#tablaGrupos").empty().append(tr);
          //
          //
          //
          //   })
          //   '</tbody>'+
          //
          //
          //   $("#tablaGrupos").append(tr);
          //
          // }




        }


    });

  }
  //////////////////////////////////////////////////////
  $(".btn-submit").click(function(e){
        e.preventDefault();

        var motivo = $("textarea[name=motivo]").val();
        var id = $("input[name=id]").val();

          $.ajax({

             type:"POST",

             url:"/registro/suspender_registro",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               motivo:motivo,
               id:id,
             },
              success:function(data){
                Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); });
                  //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ tabla.ajax.reload(); } );
              }


          });



  });
  /////////////////////ACTIVAR /////////////////////////////////
  $(".btn-submit_activar").click(function(e){
        e.preventDefault();

        var activar = $("select[name=activar]").val();
        var id = $("input[name=id_activar]").val();

          $.ajax({

             type:"POST",

             url:"/registro/activar_registro",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               activar:activar,
               id:id,
             },
              success:function(data){
                Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); });
                  //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('registro') }}"; } );
              }


          });



  });
  </script>
@endsection
