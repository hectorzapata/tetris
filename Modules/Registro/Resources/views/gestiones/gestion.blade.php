@extends('layouts.index')
@section('titulo', 'Gestiones')
@section('acciones', '')
@section('breadcumb')
  <a href='/gestiones'>Todas las Gestiones</a> > {{ isset($gestiones) ? "Editar" : "Nuevo" }}
@endsection
@section('style')
<link href="/metronic/assets/css/pages/wizard/wizard-6.css?v=7.0.6" rel="stylesheet" type="text/css">
<link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style media="screen">
.input_container ul {
	width: 206px;
	border: 1px solid #eaeaea;
	position: absolute;
	z-index: 9;
	background: #f3f3f3;
	list-style: none;
	margin-left: 5px;
margin-top: -3px;
}
.input_container ul li {
	padding: 2px;
}
.input_container ul li:hover {
	background: #eaeaea;
}

.select2-container { width: 100% !important; }
.w100 { width: 100%;}

</style>
@endsection
@section('content')
<div class="card card-custom">
    <div class="card-body pb-1">
        <!--begin::Wizard 6-->
        <div class="wizard wizard-6 d-flex flex-column flex-lg-row flex-column-fluid" id="kt_wizard" data-wizard-state="first">
            <!--begin::Container-->
            <div class="wizard-content d-flex flex-column mx-auto py-10 py-lg-20 w-100 w-md-1000px">
                <!--begin::Nav-->
                <div class="d-flex flex-column-auto flex-column px-10">




                	<div class="row">
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Nombre Completo </label>
                          <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre" value="@isset($persona) @foreach($persona as $person) {{ $person->nombre }} {{ $person->paterno }} {{ $person->materno }}  @endforeach @endisset" id="nombre" disabled>

                          <input type="hidden" name="id_ciudadano" id="id_ciudadano" value="@isset($persona) @foreach($persona as $person) {{ $person->cve_t_ciudadano }} @endforeach @endisset">

                      </div>


                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>CURP</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="CURP" name="clave_elector" value="@isset($persona) @foreach($persona as $person) {{ $person->curp }} @endforeach @endisset" id="curp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Domicilio </label>
                          <input type="text" class="form-control" placeholder="Domicilio" name="nombre" value="@isset($persona) @foreach($persona as $person) {{ $person->nombre_asentamiento }}, #{{ $person->num_ext }}, C.P:{{ $person->cp }} @endforeach @endisset" id="domicilio" disabled>
                      </div>
                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>Telefonos</label>
                        <input type="text" class="form-control" placeholder="Telefonos" name="paterno" value="@isset($persona) @foreach($persona as $person) {{ $person->numero_telefono }} @endforeach @endisset" id="telefono" disabled>
                      </div>

                    </div>

                    <div class="separator separator-dashed my-8"></div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Origen Petición </label>
                        <select class="form-control" id="origen_peticion">
                          @isset($gestiones)
                           <option value="{{ $gestiones->origen_peticion }}">{{ $gestiones->origen_peticion }}</option>
                           @else
                           <option>Selecciona un Origen</option>
                           @endisset

                        	<option value="1">Jornada</option>
                        	<option value="2">Inaguración</option>
                        </select>
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Tipo Petición</label>
                        <select class="form-control" id="tipo_peticion">
                          @isset($gestiones)
                           <option value="{{ $gestiones->tipo_peticion }}">
                             <?php
                                if ($gestiones->tipo_peticion == 1) {
                                  echo 'Individual';
                                }else{
                                  echo 'Grupal';
                                }

                              ?>
                           </option>
                           @else
                           <option>Selecciona una petición</option>
                           @endisset

                        	<option value="1">Individual</option>
                        	<option value="2">Grupal</option>
                        </select>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Categoría </label>
                          <select class="form-control" id="categoria_peticion">
                          @isset($gestiones)
                           <option value="{{ $gestiones->categoria_peticion }}">{{ $gestiones->categoria_peticion }}</option>
                           @else
                           <option>Selecciona un Origen</option>
                           @endisset
                           @foreach($tipoGestion as $gestioness)
                           <option value="{{ $gestioness->id }}">{{ $gestioness->valor }}</option>
                           @endforeach
                        </select>
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Fecha Recepción</label>
                          <input type="date" class="form-control" placeholder="Fecha Recepción" name="curp" value="@isset($gestiones){{ $gestiones->fecha_recepcion }}@endisset" id="fecha_recepcion" >
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Fecha Atendido</label>
                        <div class="input-group">
                          <input type="date" class="form-control" placeholder="Fecha Atendido" name="clave_elector" value="@isset($gestiones){{ $gestiones->fecha_atendido }}@endisset" id="fecha_atendido" >
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Fecha de Entrega </label>
                          <input type="date" class="form-control" placeholder="Fecha de Entrega" name="nombre" value="@isset($gestiones){{ $gestiones->fecha_entrega }}@endisset" id="fecha_entrega" >
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">

                          <label>Municipio </label>
                          <select class="form-control" name="municipio" id="municipio">
                            @isset($gestiones)
                             <option value="{{ $gestiones->municipio }}">{{ $gestiones->obtMUN->valor }}</option>
                             @else
                             <option>Selecciona un Municipio</option>
                             @endisset

                          	@foreach($municipio as $mun)
                          	<option value="{{ $mun->cve_mun }}">{{ $mun->nom_mun }}</option>
                          	@endforeach
                          </select>
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Gestor</label>
                        <select class="form-control" id="gestor">
                          @isset($gestiones)
                           <option value="{{ $gestiones->gestor }}">{{ $gestiones->gestor }}</option>
                           @else
                           <option>Selecciona un Gestor</option>
                           @endisset
                          @foreach($gestor as $gest)
                          <option value="{{ $gest->id }}">{{ $gest->valor }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Procedencia del Gestor </label>
                          <input type="text" class="form-control" placeholder="Procedencia del Gestor" name="nombre" value="@isset($gestiones){{ $gestiones->procedencia_gestor }}@endisset" id="procedencia_gestor" >
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Descripción de la gestión </label>
                          <textarea type="text" class="form-control" id="descripcion_gestor">@isset($gestiones){{ $gestiones->descripcion_gestor }}@endisset</textarea>

                      </div>


                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>Apoyo Otorgado</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Apoyo Otorgado" name="clave_elector" value="@isset($gestiones){{ $gestiones->apoyo_otorgado }}@endisset" id="apoyo_otorgado" >
                        </div>
                      </div>


                    </div>
                    @isset($gestiones)

                    @if($gestiones->tipo_peticion == 2)

                    <div class="separator separator-dashed my-8"></div>
                <!-- //////////// tabla Grupal //////////////////////-->


                    <div class="d-flex justify-content-between pt-7">
                        <div class="mr-2">
                            <label>Beneficiarios</label>
                        </div>

                        <div>

                          <a onclick="agregarBeneficiario()" class="btn btn-primary"  id="kt_login_signup_form_submit_button">
                            Agregar Beneficiario
                            <i class="icon-xl fab fa-elementor"></i>
                          </a>

                        </div>
                    </div>
                    <div style="height:20px;">

                    </div>

                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="tablaGrupos" style="margin-top: 13px !important" >
                            <thead>
                                <tr>
                                  <th scope="col">Representante</th>
                                  <th scope="col">Nombre Beneficiario</th>
                                  <th scope="col">CURP</th>
                                  <th scope="col">Fecha Nacimiento</th>
                                  <th scope="col">Domicilio</th>
                                  <th scope="col">Telefono</th>
                                  <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($beneficiarios as $beni)
                                <tr>
                                  <td></td>
                                  <td>{{ $beni->nombre }} {{ $beni->paterno }} {{ $beni->materno }}</td>
                                  <td>{{ $beni->curp }}</td>
                                  <td>{{ $beni->fecha_modal }}</td>
                                  <td>{{ $beni->domicilio }}</td>
                                  <td>{{ $beni->telefono }}</td>
                                  <td> <button  class="btn btn-danger"> <i class="fas fa-trash"></i> </button> </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                    @endif

                  @endisset
                    <div class="grupal">
                        <div class="separator separator-dashed my-8"></div>
                    <!-- //////////// tabla Grupal //////////////////////-->


                        <div class="d-flex justify-content-between pt-7">
                            <div class="mr-2">
                                <label>Beneficiarios</label>
                            </div>

                            <div>

                              <a onclick="agregarBeneficiario()" class="btn btn-primary"  id="kt_login_signup_form_submit_button">
                                Agregar Beneficiario
                                <i class="icon-xl fab fa-elementor"></i>
                              </a>

                            </div>
                        </div>
                        <div style="height:20px;">

                        </div>

                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="tablaGrupos" style="margin-top: 13px !important" >
                              <thead>
                                  <tr>
                                      <th scope="col">Representante</th>
                                      <th scope="col">Nombre Beneficiario</th>
                                      <th scope="col">CURP</th>
                                      <th scope="col">Fecha Nacimiento</th>
                                      <th scope="col">Domicilio</th>
                                      <th scope="col">Telefono</th>
                                      <th scope="col">Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>


                    </div>



                    <!-- /////////////////////////////////////////////// -->
                    <div class="separator separator-dashed my-8"></div>

                    <div class="d-flex justify-content-between pt-7">
                        <div class="mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pr-8 pl-6 py-4 my-3 mr-3" >

                                <i class="icon-xl fas fa-reply"></i>
                                  Atras
                            </button>
                        </div>
                        @isset($gestiones)

                        <div>

                            <a class="btn btn-primary  font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-4" onclick="bitacora('{{$gestiones->cve_t_gestiones}}')">
                              Bitacora
                              <i class="icon-xl fab fa-elementor"></i>
                            </a>

                        </div>
                        <div>

                            <a class="btn btn-primary  font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-4" onclick="estatus('{{$gestiones->cve_t_gestiones}}')">
                              Actualizar Estatus
                              <i class="icon-xl fas fa-redo"></i>
                            </a>

                        </div>
                        @endisset
                        <div>
                            <button type="button" class="btn btn-primary btn-submit font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-4"  id="kt_login_signup_form_submit_button">
                                {{ isset($gestiones) ? "Modificar" : "Guardar" }}
                               <i class="icon-xl far fa-save"></i>
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Estatus-->
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
                    <input type="date" class="form-control" placeholder="Fecha Atendido" name="curp" id="fecha_atendido_modal" >
                </div>


                <div class="col-sm-6 col-xs-12 form-group">
                  <label>Fecha Entregada</label>
                  <div class="input-group">
                    <input type="date" class="form-control" placeholder="Fecha Entregada" name="clave_elector"  id="fecha_entregada_modal" >
                  </div>
                </div>

                <div class="col-sm-12 col-xs-12 form-group">
                  <label>Apoyo Otorgado</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Apoyo Otorgado"  id="apoyo_otorgado_modal" >
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
              <button type="button" class="btn btn-light-primary font-weight-bold btn-submitrs" >Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bitacora-->
<div class="modal fade" id="bitacora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bitacora</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-sm-12 col-xs-12 form-group">
                    <label>Comentario </label>
                    <textarea type="text" class="form-control" id="comentario_bitacora"></textarea>

                </div>
                <div id="id_bit"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-light-primary font-weight-bold btn-submitbita" >Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Agregar Beneficiario-->
<div class="modal fade" id="beneficiario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Beneficiario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">
                  <div class="col-sm-6 col-xs-12 form-group">
                      <label>Buscar Ciudadano </label>

                          <input type="text"  id="ciudadano2"  class="form-control">
                          <div id="ciudadano_list2"></div>

                  </div>

              </div>

              <div class="row">

                <div class="col-sm-4 col-xs-12 form-group">
                  <label>CURP</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="CURP" name="clave_elector" id="curp_modal" >
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12 form-group">
                  <label>RFC</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="RFC" name="clave_elector"  id="rfc_modal" >
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12 form-group">
                  <label>Fecha Nacimiento</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Fecha Nacimiento" name="clave_elector"  id="fech_modal" >
                  </div>
                </div>

              </div>

              <div class="row">
                  <div class="col-sm-4 col-xs-12 form-group">
                      <label>Nombre </label>
                      <input type="text" class="form-control" placeholder="Nombre " name="nombre"  id="nombre_modal" >

                      <input type="hidden" name="id_ciudadano" id="id_ciudadano" >

                  </div>

                  <div class="col-sm-4 col-xs-12 form-group">
                      <label>Apellido Paterno </label>
                      <input type="text" class="form-control" placeholder="Apellido Paterno" name="nombre" id="paterno_modal" >

                  </div>

                  <div class="col-sm-4 col-xs-12 form-group">
                      <label>Apellido Materno </label>
                      <input type="text" class="form-control" placeholder="Apellido Materno" name="nombre"  id="materno_modal" >

                  </div>
              </div>

              <div class="row">
                <div class="col-sm-6 col-xs-12 form-group">
                    <label>Domicilio </label>
                    <input type="text" class="form-control" placeholder="Domicilio" name="nombre"  id="domicilio_modal" >
                </div>
                <div class="col-sm-6 col-xs-12 form-group">
                  <label>Telefonos</label>
                  <input type="text" class="form-control" placeholder="Telefonos" name="paterno"  id="telefono_modal" >

                  <input type="hidden" name="" id="id_ciudadano_modal">
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-light-primary font-weight-bold" id="submitBene" >Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
<script >
var arrayFiguras = [];
var objFigura = {};
// var tabla;
// $(function() {
//   tabla = $('#kt_datatable').DataTable({
//     processing: true,
//     serverSide: true,
//     order: [[0, 'desc']],
//     ajax: {
//       url: "/gestiones/tablaBeneficiarios",
//     },
//     columns: [
//       { data: 'representante', name: 'representante' },
//       { data: 'nombre', name: 'nombre', searchable: false, orderable:false },
//       { data: 'domicilio', name: 'domicilio' , searchable: false, orderable:false},
//       { data: 'municipio', name: 'municipio', searchable: false, orderable:false },
//        { data: 'telefono', name: 'telefono', searchable: false, orderable:false },
//
//       { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
//     ],
//     createdRow: function ( row, data, index ) {
//       $(row).find('.ui.dropdown.acciones').dropdown();
//     },
//     language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
//   });
// });
///////////////////////// BUSCAR 2 ///////////////////////////////////////////////////////
$(document).ready(function () {

     $('#ciudadano').on('keyup',function() {
         var query = $(this).val();
         $.ajax({

             url:"/gestiones/search",

             type:"GET",

             data:{'ciudadano':query},

             success:function (data) {

                 $('#ciudadano_list').html(data);
             }
         })
         // end of ajax call
     });


     $(document).on('click', 'li', function(){

         var value = $(this).text();
         $('#ciudadano').val(value);
         $('#ciudadano_list').html("");
     });

     //////////////////// SEARCH 2 /////////////////////////////////////

     $('#ciudadano2').on('keyup',function() {
         var querys = $(this).val();
         $.ajax({

             url:"/gestiones/search2",

             type:"GET",

             data:{'ciudadano':querys},

             success:function (data) {

                 $('#ciudadano_list2').html(data);
             }
         })
         // end of ajax call
     });


     $(document).on('click', 'li', function(){

         var value = $(this).text();
         $('#ciudadano2').val(value);
         $('#ciudadano_list2').html("");
     });



 });
/////////////////////////////////////////////////////////////////////////////////////////
	$(document).ready( function () {

    ///////////////////////// MOSTRAR ///////////////////////////////////////

    $('.grupal').hide();

    $("#tipo_peticion").change(function(){

      var tipo_peticion = $("#tipo_peticion").val();

        if(tipo_peticion == 2){
            $('.grupal').show();
        } else {
            $('.grupal').hide();
        }

    });


    ///////////////////// CREAR Y EDITAR ///////////////////////////////////////////

     $(".btn-submit").click(function(e){


        e.preventDefault();



         var nombre = $("#nombre").val();
         var id_ciudadano = $("#id_ciudadano").val();
         var curp = $("#curp").val();
         var domicilio = $("#domicilio").val();
         var telefono = $("#telefono").val();
         var origen_peticion = $("#origen_peticion").val();
         var tipo_peticion = $("#tipo_peticion").val();
         var categoria_peticion = $("#categoria_peticion").val();
         var fecha_recepcion = $("#fecha_recepcion").val();
         var fecha_atendido = $("#fecha_atendido").val();
         var fecha_entrega = $("#fecha_entrega").val();
         var municipio = $("#municipio").val();
         var gestor = $("#gestor").val();
         var procedencia_gestor = $("#procedencia_gestor").val();
         var descripcion_gestor = $("#descripcion_gestor").val();
         var apoyo_otorgado = $("#apoyo_otorgado").val();

         if (fecha_recepcion == 0 || apoyo_otorgado == '' || municipio == '') {
           Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
         }else{
           $.ajax({

              type:"{{ ( isset($gestiones) ? 'PUT' : 'POST' ) }}",

              url:"{{ ( isset($gestiones) ) ? '/gestiones/' . $gestiones->cve_t_gestiones : '/gestiones/create' }}",
              headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data:{
                nombre:nombre,
                id_ciudadano:id_ciudadano,
                curp:curp,
                domicilio:domicilio,
                telefono:telefono,
                origen_peticion:origen_peticion,
                tipo_peticion:tipo_peticion,
                categoria_peticion:categoria_peticion,
                fecha_recepcion:fecha_recepcion,
                fecha_atendido:fecha_atendido,
                fecha_entrega:fecha_entrega,
                municipio:municipio,
                gestor:gestor,
                procedencia_gestor:procedencia_gestor,
                descripcion_gestor:descripcion_gestor,
                apoyo_otorgado:apoyo_otorgado,
                arrayFiguras:arrayFiguras,

              },

               success:function(data){
                 Swal.fire("Excelente!", data.success, "success").then(function(){ location.href ="{{ url('registro') }}"; });
                   //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
               }


           });
         }





        });

	});


// Funcion Mostrar valores
function set_item(id) {
	// Cambiar el valor del formulario input
	//$('#pais_id').val(opciones);

var id = id;
$.ajax({
  url: '/gestiones/create/TraerPersona',
  type: 'POST',
  headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  data: {id:id},
  success:function(data){
    //console.log(data);

    for (var i = data.length - 1; i >= 0; i--) {

      var nombre_completo = data[i].nombre+' '+data[i].paterno+' '+data[i].materno;

       var curp =  data[i].curp;
      //
       var domicilio = data[i].nombre_asentamiento+',#'+data[i].num_ext+',C.P:'+data[i].cp;
       var telefono = data[i].numero_telefono;
      //
      $('#nombre_modal').val(data[i].nombre);
      $('#paterno_modal').val(data[i].paterno);
      $('#materno_modal').val(data[i].materno);
      $('#curp_modal').val(curp);
      $('#fech_modal').val(data[i].fecha_naciminto);
      $('#domicilio_modal').val(domicilio);
      $('#telefono_modal').val(telefono);
      $('#id_ciudadano_modal').val(data[i].cve_t_ciudadano);




    }
  }
});

	// ocultar lista de proposiciones
	$('#lista_id').hide();
}

function set_item2(id){
  var id = id;
  $.ajax({
    url: '/gestiones/create/TraerPersona',
    type: 'POST',
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {id:id},
    success:function(data){
      //console.log(data);

      for (var i = data.length - 1; i >= 0; i--) {

        var nombre_completo = data[i].nombre+' '+data[i].paterno+' '+data[i].materno;

         var curp =  data[i].curp;
        //
         var domicilio = data[i].nombre_asentamiento+',#'+data[i].num_ext+',C.P:'+data[i].cp;
         var telefono = data[i].numero_telefono;
        //
        $('#nombre').val(data[i].nombre);
        $('#paterno').val(data[i].paterno);
        $('#materno').val(data[i].materno);
        $('#curp').val(curp);
        //$('#fech_modal').val(data[i].fecha_naciminto);
        $('#domicilio').val(domicilio);
        $('#telefono').val(telefono);
        $('#id_ciudadano').val(data[i].cve_t_ciudadano);




      }
    }
  });
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

  function bitacora(id){

      $('#bitacora').modal('show');

      $('#id_bit').html('<input type="hidden" value="'+id+'" id="id_bitacora"/>');

  }

  //////////////////////////////////////////////////////////////////////////
  function agregarBeneficiario(){

    $('#beneficiario').modal('show');

  }

  ///////////////////////////////////////////////////////////////////////////
  function estatus(id){

    $('#estatus_gestiones').modal('show');

    $('#id_gest').html('<input type="hidden" value="'+id+'" id="id_gestion"/>');


  }
  //////////////////////////////////////////////////////////////////////////////
    $(document).ready( function () {
      $(".btn-submitrs").click(function(e){


         e.preventDefault();



          var estatus = $("#estatus").val();
          var fecha_atendido = $("#fecha_atendido_modal").val();
          var fecha_entregada = $("#fecha_entregada_modal").val();
          var apoyo_otorgado = $("#apoyo_otorgado_modal").val();
          var descripcion_estatus = $("#descripcion_estatus").val();
          var id_gestion =  $("#id_gestion").val();


          if (estatus == 0) {
            Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
          }else if(estatus == 2){

            if (fecha_atendido == 0 || fecha_entregada == 0|| apoyo_otorgado == '') {
              Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
            }else{
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
                      var fecha_atendido = $("#fecha_atendido_modal").val('');
                      var fecha_entregada = $("#fecha_entregada_modal").val('');
                      var apoyo_otorgado = $("#apoyo_otorgado_modal").val('');
                      var descripcion_estatus = $("#descripcion_estatus").val('');

                      location.href ="{{ url('gestiones') }}";

                    });
                      //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
                  }


              });
            }
          }else{
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
                    var fecha_atendido = $("#fecha_atendido_modal").val('');
                    var fecha_entregada = $("#fecha_entregada_modal").val('');
                    var apoyo_otorgado = $("#apoyo_otorgado_modal").val('');
                    var descripcion_estatus = $("#descripcion_estatus").val('');

                    location.href ="{{ url('gestiones') }}";

                  });
                    //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
                }


            });
          }


         });


         $(document).on("click","#submitBene",function(e){
               //$("#btnAgregarFierro").hide();
                e.preventDefault();


                var nombre = $('#nombre_modal').val();
                var paterno = $('#paterno_modal').val();
                var materno = $('#materno_modal').val();
                var curp = $('#curp_modal').val();
                var fecha_modal = $('#fech_modal').val();
                var domicilio = $('#domicilio_modal').val();
                var telefono = $('#telefono_modal').val();
                var id_ciudadano = $('#id_ciudadano_modal').val();
                //console.log(nombre);


                if (curp == '') {
                Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
                }else{
                  objFigura = {
                     nombre : $('#nombre_modal').val(),
                     paterno : $('#paterno_modal').val(),
                     materno : $('#materno_modal').val(),
                     curp : $('#curp_modal').val(),
                     fecha_modal : $('#fech_modal').val(),
                     domicilio : $('#domicilio_modal').val(),
                     telefono : $('#telefono_modal').val(),
                     id_ciudadano : $('#id_ciudadano_modal').val(),
                  };




                  indexH = arrayFiguras.push(objFigura);
                  objFigura.id = indexH;

                  //console.log(arrayFiguras);

                  $('#beneficiario').modal('hide');

                  var tr = '<tr id="id-figura-'+objFigura.id+'">'+
                  '<td><input type="hidden" id="figura_nueva" value="'+objFigura.id+'"/>'+
                  '<td>'+ objFigura.nombre +' '+objFigura.paterno +' '+objFigura.materno +'</td>'+
                  '<td>'+ objFigura.curp +'</td>'+
                  '<td>'+ objFigura.fecha_modal +'</td>'+
                  '<td>'+ objFigura.domicilio +'</td>'+
                  '<td>'+ objFigura.telefono +'</td>'+
                  '<td style=" text-align: center; "><button class="btn btn-danger"><i id="'+objFigura.id+'" class="fas fa-trash"></i></button></td>'
                  // <div id="'+objFigura.id+'" figura_nueva_id = "'+objFigura.id+'" class="  borrar_figura"> <i id="'+objFigura.id+'" class="fas fa-trash"></i></div></td>'
                  '</tr>';
                  $("#tablaGrupos").append(tr);



                   $('#ciudadano2').val('');
                   $('#nombre_modal').val('');
                   $('#paterno_modal').val('');
                   $('#materno_modal').val('');
                   $('#curp_modal').val('');
                   $('#fech_modal').val('');
                   $('#domicilio_modal').val('');
                   $('#telefono_modal').val('');
                   $('#id_ciudadano_modal').val('');

                  // $('#clasificacion').dropdown('restore defaults');
                  // $('#cve_cat_tipo_gnd').dropdown('restore defaults');
                  // $('#cve_cat_tipo_fierro').dropdown('restore defaults');
                  // $('#file').val('');

                }


                 //totalH = (parseInt(totalH) + parseInt(valorH));

                 //arrayHectareas.push(objHectarea);
             });



    });

  ////////////////////////////////////////////////////////////////////////////////


  ////////////////////// ELIMINAR /////////////////////////////////////////////
  function EliminarBeneficiario(id){
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

                   url:"/gestiones/EliminarBeneficiario",
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
