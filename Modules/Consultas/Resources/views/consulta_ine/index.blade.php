@extends('layouts.index')
@section('titulo', 'Consultas INE')
@section('acciones', '')
@section('breadcumb', 'Todos las Consultas INE')
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
      <h3 class="card-label">Consulta Ciudadano con Datos INE</h3>
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
            <option value="2">Por Datos INE</option>
            <option value="3">Por Datos Generales</option>
            <option value="4">Por Domicilio</option>
            <option value="5">Por Datos de Localización</option>
          </select>
        </div>

    </div>
    <div class="separator separator-dashed mt-8 mb-5"></div>
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
<!--begin::Page Vendors(used by this page)-->
<script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
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
});
</script>
@endsection
