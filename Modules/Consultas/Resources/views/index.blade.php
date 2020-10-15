@extends('layouts.index')
@section('titulo', 'Consultas')
@section('acciones', '')
@section('breadcumb', 'Todos las Consultas')
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
      <h3 class="card-label">Consulta Ciudadana</h3>
    </div>
    <div class="card-toolbar">

    </div>
  </div>
  <div class="card-body">
    <div class="row">


        <div class="col-sm-4 col-xs-12 form-group">
          <label>Filtros Consulta</label>
          <div></div>
          <select class=" form-control" name="filtros" id="filtros">
            <option value="0">Selecciona un Filtro</option>
            <option value="1">Por Estructura</option>
            <option value="2">Por Datos INE</option>
            <option value="3">Por Datos Generales</option>
            <option value="4">Por Domicilio</option>
            <option value="5">Por Datos de Localización</option>
          </select>
        </div>

    </div>
    <div class="separator separator-dashed mt-8 mb-5"></div>
    <!--////////////////////////////////////////////////////////////////-->
    <div class="row  existeestatus" style="display: none;">
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Estructura</label>
        <div></div>
        <select class=" form-control" name="" id="">
          <option value="0">Selecciona una Estructura</option>

        </select>
      </div>
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Nombre del Nivel 1</label>
        <div></div>
        <select class=" form-control" name="filtros" id="filtros">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Nombre del Nivel 2</label>
        <div></div>
        <select class=" form-control" name="filtros" id="filtros">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Nombre del Nivel 3</label>
        <div></div>
        <select class=" form-control" name="filtros" id="filtros">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Nombre del Nivel 4</label>
        <div></div>
        <select class=" form-control" name="filtros" id="filtros">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Nombre del Nivel 5</label>
        <div></div>
        <select class=" form-control" name="filtros" id="filtros">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Nombre del Nivel 6</label>
        <div></div>
        <select class=" form-control" name="filtros" id="filtros">
          <option value="0">Selecciona un Nivel</option>

        </select>
        <div style="height:25px;"></div>
        <a href="javascript:uabovino()" class="btn btn-primary">filtrar</a>
      </div>

    </div>
    <!--////////////////////////////////////////////////////////////////-->
    <div class="row  existeestatus2" style="display: none;">
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Distrito Federal</label>
        <div></div>
        <select class=" form-control" name="distrito_fed" id="distrito_fed" data-nivel="1">
          <option value="0">Selecciona un Dsitrito Federal</option>
          @foreach($distrito_federal as $df)
          <option value="{{ $df->id }}">{{ $df->valor }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Distrito Local</label>
        <div></div>
        <select class=" form-control" name="distrito_loc" id="distrito_loc" data-nivel="2">
          <option value="0">Selecciona un Dsitrito Local</option>
          @foreach($distrito_local as $dl)
          <option value="{{ $dl->id }}">{{ $dl->valor }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Sección</label>
        <div></div>
        <select class=" form-control" name="seccion" id="seccion" data-nivel="3">
          <option value="0">Selecciona una Sección</option>

        </select>
      </div>
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Datos INE</label>
        <div></div>
        <select class=" form-control" name="datos_inee" id="datos_inee">
          <option value="0">Todos</option>
          <option value="1">Verificados</option>
          <option value="2">No Verificado</option>

        </select>
        <div style="height:25px;"></div>


        <a href="javascript:ine()" class="btn btn-primary">filtrar</a>
      </div>
    </div>

    <div class="row  existeestatus3" style="display: none;">

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Estatus del Ciudadano</label>
        <div></div>
        <select class=" form-control" name="filtros" id="estatus_ciudadano">
          <option value="0">Selecciona un Nivel</option>
          <option value="1">Registrado</option>
          <option value="2">Entregada</option>
          <option value="3">En Proceso</option>
          <option value="4">Pendiente</option>
          <option value="5">Cancelada</option>

        </select>

        <div style="height:25px;"></div>
        <a href="javascript:Generales()" class="btn btn-primary">filtrar</a>
      </div>
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Genero</label>
        <div></div>
        <select class=" form-control" name="filtros" id="id_genero">
          <option value="0">Selecciona un Nivel</option>
          <option >Todos</option>
          <option value="H">H</option>
          <option value="M">M</option>

        </select>
      </div>
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Rango de Edad</label>
        <div></div>
        <select class=" form-control" name="filtros" id="id_rango_eddad">
          <option value="0">Selecciona un Nivel</option>
          <option value="0">Todos</option>

        </select>


      </div>
    </div>

    <!--////////////////////////////////////////////////////////////////-->
    <div class="row  existeestatus4" style="display: none;">
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Municipio</label>
        <div></div>
        <select class=" form-control" name="filtros" id="municipio_dom">
          <option value="0">Selecciona un Municipio</option>
          @foreach($municipio as $mun)
          <option value="{{ $mun->id }}">{{ $mun->valor }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Localidad</label>
        <div></div>
        <select class=" form-control" name="filtros" id="localidad_dom">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Codigo Postal</label>
        <div></div>
        <select class=" form-control" name="filtros" id="cp_dom" data-nivel="1">
          <option value="0">Selecciona un Nivel</option>
          @foreach($codigo_postal as $cp)
          <option value="{{ $cp->id }}">{{ $cp->valor }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Colonia</label>
        <div></div>
        <select class=" form-control" name="filtros" id="col_dom" data-nivel="2">
          <option value="0">Selecciona un Nivel</option>

        </select>

        <div style="height:25px;"></div>
        <a href="javascript:domicilio()" class="btn btn-primary">filtrar</a>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Datos Domicilio</label>
        <div></div>
        <select class=" form-control" name="filtros" id="dom_dom">
          <option value="0">Selecciona un Nivel</option>

        </select>
      </div>
    </div>
    <!--////////////////////////////////////////////////////////////////-->
    <div class="row  existeestatus5" style="display: none;">
      <div class="col-sm-4 col-xs-12 form-group">
        <label>Correo Electronico</label>
        <div></div>
        <select class=" form-control" name="filtros" id="correo_electronico">
          <option value="0">Selecciona un Nivel</option>
          <option value="1">Todos</option>
          <option value="2">No Tiene</option>
        </select>

        <div style="height:25px;"></div>
        <a href="javascript:localizacion()" class="btn btn-primary">filtrar</a>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Teléfono</label>
        <div></div>
        <select class=" form-control" name="filtros" id="telefonos">
          <option value="0">Selecciona un Nivel</option>
          <option value="1">Todos</option>
          <option value="2">No Tiene</option>
        </select>
      </div>

      <div class="col-sm-4 col-xs-12 form-group">
        <label>Redes Sociales</label>
        <div></div>
        <select class=" form-control" name="filtros" id="redes_sociales">
          <option value="0">Selecciona un Nivel</option>
          <option value="1">Todos</option>
          <option value="2">No Tiene</option>
        </select>
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
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>CURP</th>
                <th>Calle Dom.</th>
                <th>Colonia Dom.</th>
                <th>C.P</th>
                <th>Localidad</th>
                <th>Municipio</th>
                <th>Nombre Estructura</th>
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

<!--begin::Page Vendors(used by this page)-->

<!--end::Page Vendors-->
<script>

$('#distrito_fed').select2();
$('#distrito_loc').select2();
$('#seccion').select2();
$('#datos_inee').select2();
$('#estatus_ciudadano').select2();
$('#id_genero').select2();
$('#id_rango_eddad').select2();
$('#municipio_dom').select2();
$('#localidad_dom').select2();
$('#cp_dom').select2();
$('#col_dom').select2();
$('#dom_dom').select2();

$('#correo_electronico').select2();
$('#telefonos').select2();
$('#redes_sociales').select2();


$(document).ready( function () {
  $("select[name=filtros]").change(function(){

    var filtro = $("select[name=filtros]").val();

    if (filtro == 1) {

      $('.existeestatus').show();
      $('.existeestatus2').hide();
      $('.existeestatus3').hide();
      $('.existeestatus4').hide();
      $('.existeestatus5').hide();
      $('.tabla').hide();

    }else if(filtro == 2){
      $('.existeestatus').hide();
      $('.existeestatus2').show();
      $('.existeestatus3').hide();
      $('.existeestatus4').hide();
      $('.existeestatus5').hide();
      $('.tabla').hide();


    }else if(filtro == 3){
      $('.existeestatus').hide();
      $('.existeestatus2').hide();
      $('.existeestatus3').show();
      $('.existeestatus4').hide();
      $('.existeestatus5').hide();
      $('.tabla').hide();

    }else if(filtro == 4){
      $('.existeestatus').hide();
      $('.existeestatus2').hide();
      $('.existeestatus3').hide();
      $('.existeestatus4').show();
      $('.existeestatus5').hide();
      $('.tabla').hide();

    }else if(filtro == 5){
      $('.existeestatus').hide();
      $('.existeestatus2').hide();
      $('.existeestatus3').hide();
      $('.existeestatus4').hide();
      $('.existeestatus5').show();

    }else if(filtro == 0){
      $('.existeestatus').hide();
      $('.existeestatus2').hide();
      $('.existeestatus3').hide();
      $('.existeestatus4').hide();
      $('.existeestatus5').hide();
      $('.tabla').hide();

    }



  });
  /////////////////////////////////////////////////
  $("#distrito_fed").change(function(){

    var df = $("#distrito_fed").val();

      nivel = parseInt($(this).attr('data-nivel'));

      $.ajax({

         type:"GET",

         url:"/consultas/distrito_local",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           df:df,
         },

          success:function(data){

            if (data) {


              for(i = nivel + 1; i <= 3; i++){
                /*$('#centrosalud_value.dropdown[data-nivel="'+i+'"]').empty();
                $('#centrosalud_value.dropdown[data-nivel="'+i+'"]').dropdown('restore default text');*/
                $('#distrito_loc').empty();

              }data.forEach((x) => {

                /*$('#centrosalud_value.dropdown[data-nivel="'+(nivel + 1)+'"]').find('.menu')
                .append(
                  "<div class='item' data-value='"+x.cve_cat_centro+"'>"+x.clave+" "+x.nombre+"</div>"
                );*/
                //document.getElementById("centrosalud_value").style.display = 'block';

                $('#distrito_loc').append('<option value="'+x.id+'">'+x.valor+'-'+x.municipio+'</option>');

              });

            }
            //$('#seccion').append('<option value="'+data.id+'">'+data.valor+'</option>');

          }
    });

  });
  /////////////////////// CP A COLONIAS /////////////////////////////////////

  $("#cp_dom").change(function(){

    var cp = $("#cp_dom").val();

      nivel = parseInt($(this).attr('data-nivel'));

      $.ajax({

         type:"GET",

         url:"/consultas/Concolonia",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           cp:cp,
         },

          success:function(data){

            if (data) {


              for(i = nivel + 1; i <= 3; i++){
                /*$('#centrosalud_value.dropdown[data-nivel="'+i+'"]').empty();
                $('#centrosalud_value.dropdown[data-nivel="'+i+'"]').dropdown('restore default text');*/
                $('#col_dom').empty();

              }data.forEach((x) => {

                /*$('#centrosalud_value.dropdown[data-nivel="'+(nivel + 1)+'"]').find('.menu')
                .append(
                  "<div class='item' data-value='"+x.cve_cat_centro+"'>"+x.clave+" "+x.nombre+"</div>"
                );*/
                //document.getElementById("centrosalud_value").style.display = 'block';

                $('#col_dom').append('<option value="'+x.id+'">'+x.valor+'</option>');

              });




            }
            //$('#seccion').append('<option value="'+data.id+'">'+data.valor+'</option>');

          }
    });

  });

  /////////////////////////////////////////////////
  $("#distrito_loc").change(function(){

    var dl = $("#distrito_loc").val();

      nivel = parseInt($(this).attr('data-nivel'));

      $.ajax({

         type:"GET",

         url:"/consultas/seccion",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           dl:dl,
         },

          success:function(data){

            if (data) {


              for(i = nivel + 1; i <= 3; i++){
                /*$('#centrosalud_value.dropdown[data-nivel="'+i+'"]').empty();
                $('#centrosalud_value.dropdown[data-nivel="'+i+'"]').dropdown('restore default text');*/
                $('#seccion').empty();

              }data.forEach((x) => {

                /*$('#centrosalud_value.dropdown[data-nivel="'+(nivel + 1)+'"]').find('.menu')
                .append(
                  "<div class='item' data-value='"+x.cve_cat_centro+"'>"+x.clave+" "+x.nombre+"</div>"
                );*/
                //document.getElementById("centrosalud_value").style.display = 'block';

                $('#seccion').append('<option value="'+x.valor+'">'+x.valor+'</option>');

              });




            }
            //$('#seccion').append('<option value="'+data.id+'">'+data.valor+'</option>');

          }
    });

  });


});

function domicilio(){
  var municipio_dom = $('#municipio_dom').val();
  var localidad_dom = $('#localidad_dom').val();
  var cp_dom = $('#cp_dom').val();
  var col_dom = $('#col_dom').val();
  var dom_dom = $('#dom_dom').val();

  if (municipio_dom == 0) {
    Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
  }else{
    $('.tabla').show();
    tablaPersonas = $('#kt_datatable').DataTable({
      dom: 'Bfrtip',
      buttons: [ {
        extend: 'excelHtml5',
        autoFilter: true,
        sheetName: 'Datos Domicilio',
        title: 'Datos Domicilio'
    } ],
      processing: true,
      serverSide: true,
      stateSave: true,
      "bDestroy": true,
      ajax:{
          'type': 'GET',
          'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
          'url' : '/consultas/traerTablaDomicilio',
          'data':{  municipio_dom: $('#municipio_dom').val(),
                    localidad_dom: $('#localidad_dom').val(),
                    cp_dom: $('#cp_dom').val(),
                    col_dom: $('#col_dom').val()  }
      },
      columns: [
        { data: 'nombre', name: 'nombre' },
        { data: 'paterno', name: 'paterno' },
        { data: 'materno', name: 'materno' },



        { data: 'curp', name: 'curp' },

        { data: 'calle_domicilio', name: 'calle_domicilio' },
        { data: 'nombre_asentamiento', name: 'nombre_asentamiento' },
        { data: 'cp', name: 'cp' },
        { data: 'localidad', name: 'localidad' },
        { data: 'cve_mun', name: 'cve_mun' },

        { data: 'nombre_estructura', name: 'nombre_estructura' },


        //{ data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  }

}

  function ine() {
    var distrito_fed = $('#distrito_fed').val();
    var distrito_loc = $('#distrito_loc').val();
    var seccion = $('#seccion').val();
    var datos_inee = $('#datos_inee').val();


    if (distrito_fed == 0 || distrito_loc == 0 || seccion == 0  ) {
      Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
    }else{
      $('.tabla').show();
      tablaPersonas = $('#kt_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [ {
          extend: 'excelHtml5',
          autoFilter: true,
          sheetName: 'Datos INE',
          title: 'Datos INE'
      } ],
        processing: true,
        serverSide: true,
        stateSave: true,
        "bDestroy": true,
        ajax:{
            'type': 'GET',
            'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
            'url' : '/consultas/traerTablaIne',
            'data':{  distrito_fed: $('#distrito_fed').val(),
                      distrito_loc: $('#distrito_loc').val(),
                      seccion: $('#seccion').val(),
                      datos_inee: $('#datos_inee').val()  }
        },
        columns: [
          { data: 'nombre', name: 'nombre' },
          { data: 'paterno', name: 'paterno' },
          { data: 'materno', name: 'materno' },



          { data: 'curp', name: 'curp' },

          { data: 'calle_domicilio', name: 'calle_domicilio' },
          { data: 'nombre_asentamiento', name: 'nombre_asentamiento' },
          { data: 'cp', name: 'cp' },
          { data: 'localidad', name: 'localidad' },
          { data: 'cve_mun', name: 'cve_mun' },

          { data: 'nombre_estructura', name: 'nombre_estructura' },


          //{ data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
        ],
        createdRow: function ( row, data, index ) {
          $(row).find('.ui.dropdown.acciones').dropdown();
        },
        language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
      });
    }



  }

  function Generales() {

    var estatus_ciudadano = $('#estatus_ciudadano').val();
    var id_genero = $('#id_genero').val();
    var id_rango_eddad = $('#id_rango_eddad').val();
    // var datos_inee = $('#datos_inee').val();
    //
    //
    if (estatus_ciudadano == 0 || id_genero == 0   ) {
      Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
    }else{
      $('.tabla').show();
      tablaPersonas = $('#kt_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [ {
          extend: 'excelHtml5',
          autoFilter: true,
          sheetName: 'Datos Generales',
          title: 'Datos Generales'
      } ],
        processing: true,
        serverSide: true,
        stateSave: true,
        "bDestroy": true,
        ajax:{
            'type': 'GET',
            'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
            'url' : '/consultas/traerTablaGenerales',
            'data':{  estatus_ciudadano: $('#estatus_ciudadano').val(),
                      id_genero: $('#id_genero').val(),
                      id_rango_eddad: $('#id_rango_eddad').val()
                    }
        },
        columns: [
          { data: 'nombre', name: 'nombre' },
          { data: 'paterno', name: 'paterno' },
          { data: 'materno', name: 'materno' },



          { data: 'curp', name: 'curp' },

          { data: 'calle_domicilio', name: 'calle_domicilio' },
          { data: 'nombre_asentamiento', name: 'nombre_asentamiento' },
          { data: 'cp', name: 'cp' },
          { data: 'localidad', name: 'localidad' },
          { data: 'cve_mun', name: 'cve_mun' },

          { data: 'nombre_estructura', name: 'nombre_estructura' },


          //{ data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
        ],
        createdRow: function ( row, data, index ) {
          $(row).find('.ui.dropdown.acciones').dropdown();
        },
        language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
      });
    }



  }

  function localizacion(){

    var correo_electronico = $('#correo_electronico').val();
    var telefonos = $('#telefonos').val();
    var redes_sociales = $('#redes_sociales').val();
    // var datos_inee = $('#datos_inee').val();
    //
    //
    if (estatus_ciudadano == 0 || id_genero == 0   ) {
      Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
    }else{
      $('.tabla').show();
      tablaPersonas = $('#kt_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [ {
          extend: 'excelHtml5',
          autoFilter: true,
          sheetName: 'Datos Localizacion',
          title: 'Datos Localizacion'
              } ],
        processing: true,
        serverSide: true,
        stateSave: true,
        "bDestroy": true,
        ajax:{
            'type': 'GET',
            'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
            'url' : '/consultas/traerTablaLocalizacion',
            'data':{  correo_electronico: $('#correo_electronico').val(),
                      telefonos: $('#telefonos').val(),
                      redes_sociales: $('#redes_sociales').val()
                    }
        },
        columns: [
          { data: 'nombre', name: 'nombre' },
          { data: 'paterno', name: 'paterno' },
          { data: 'materno', name: 'materno' },



          { data: 'curp', name: 'curp' },

          { data: 'calle_domicilio', name: 'calle_domicilio' },
          { data: 'nombre_asentamiento', name: 'nombre_asentamiento' },
          { data: 'cp', name: 'cp' },
          { data: 'localidad', name: 'localidad' },
          { data: 'cve_mun', name: 'cve_mun' },

          { data: 'nombre_estructura', name: 'nombre_estructura' },


          //{ data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
        ],
        createdRow: function ( row, data, index ) {
          $(row).find('.ui.dropdown.acciones').dropdown();
        },
        language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
      });
    }
  }


</script>
@endsection
