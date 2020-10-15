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
                          <label>Buscar Ciudadano </label>
                          <input type="text"  id="ciudadano" placeholder="Buscar Ciudadano" class="form-control">
                          <div id="ciudadano_list"></div>
                      </div>
                      @isset($gestiones)
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Estatus </label>
                          <p>
                              <?php

                                if ($gestiones->estatus == 1) {
                                  echo 'Registrado';
                                }elseif($gestiones->estatus == 2){
                                  echo 'Entregada';
                                }elseif($gestiones->estatus == 3){
                                  echo 'En Proceso';
                                }elseif($gestiones->estatus == 4){
                                  echo 'Pendiente';
                                }elseif($gestiones->estatus == 5){
                                  echo 'Cancelada';
                                }

                               ?>

                          </p>
                      </div>
                      @endisset

                  </div>


                	<div class="row">
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Nombre Completo </label>
                          <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre" value="@isset($persona) @foreach($persona as $person) {{ $person->nombre }} {{ $person->paterno }} {{ $person->materno }}  @endforeach @endisset" id="nombre" disabled>

                          <input type="hidden" name="id_ciudadano" id="id_ciudadano" value="@isset($ciudadano_id) {{ $ciudadano_id }} @endisset">

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
                           <option value="{{ $gestiones->origen_peticion }}">
                             <?php
                             if($gestiones->origen_peticion == 1){
                               echo 'Jornada';
                             }else{
                               echo 'Inaguración';
                             }
                              ?>
                           </option>
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
                           <option value="{{ $gestiones->categoria_peticion }}">{{ $gestiones->obtCategoria->valor }}</option>
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
                           <option value="{{ $gestiones->gestor }}">{{ $gestiones->obtGestor->valor }}</option>
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

                                  <th scope="col">Nombre Beneficiario</th>
                                  <th scope="col">CURP</th>
                                  <th scope="col">Fecha Nacimiento</th>
                                  <th scope="col">Domicilio</th>
                                  <th scope="col">Telefono</th>
                                  <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($beneficiarios as $key => $beni)
                              <tr id="fila_disciplina_taller{{ $key }}">
                                <input type="hidden" id="fig_disciplina_taller" value="{{ $beni->cve_t_beneficiario }}">
                                <input type="hidden" id="disciplina_taller" value="{{ $key }}">
                                  <td>{{ $beni->nombre }} {{ $beni->paterno }} {{ $beni->materno }}</td>
                                  <td>{{ $beni->curp }}</td>
                                  <td>{{ $beni->fecha_modal }}</td>
                                  <td>{{ $beni->domicilio }}</td>
                                  <td>{{ $beni->telefono }}</td>
                                  <td style="text-align:center;"><button disciplina_taller_id="{{ $key }}" class="btn btn-danger  button" id="eliminarMayor"><i class="fas fa-trash"></i></button></td>

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
                                        <!-- <th scope="col">Representante</th> -->
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


                    <!--//////////////////BITACORAS////////////////////////////////-->
                    @isset($gestiones)
                    <div class="separator separator-dashed my-8"></div>
                    <div class="card card-custom gutter-b">
                        <div class="card-header card-header-tabs-line">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_3">
                                            <span class="nav-icon"><i class="fas fa-sitemap"></i></span>
                                            <span class="nav-text">Estructura</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_3">
                                            <span class="nav-icon"><i class="fas fa-people-carry"></i></span>
                                            <span class="nav-text">Gestiones</span>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_3">
                                            <span class="nav-icon"><i class="fas fa-file-alt"></i></span>
                                            <span class="nav-text">Bitacoras</span>
                                        </a>
                                     </li>
                                     <li class="nav-item dropdown">
                                         <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_3">
                                             <span class="nav-icon"><i class="fas fa-phone-alt"></i></span>
                                             <span class="nav-text">Llamadas</span>
                                         </a>
                                      </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1_3" role="tabpanel" aria-labelledby="kt_tab_pane_1_3">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_2_3" role="tabpanel" aria-labelledby="kt_tab_pane_2_3">
                                  <!--///////////// gestiones tabla ///////////////////-->
                                  <table class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col">Fecha Recepción</th>
                                          <th scope="col">Tipo Petición</th>
                                          <th scope="col">Tipo Apoyo</th>
                                          <th scope="col">Descripción Apoyo</th>
                                          <th scope="col">Gestor</th>
                                          <th scope="col">Municipio</th>
                                          <th scope="col">Fecha Atendido</th>
                                          <th scope="col">Apoyo Otorgado</th>
                                          <th scope="col">Estatus</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($gestione as $gestion)
                                      <tr>
                                          <td>{{ $gestion->fecha_recepcion }}</td>
                                          <td>
                                            <?php
                                              if ($gestion->tipo_peticion == 1) {
                                                echo 'Individual';

                                              }else{
                                                echo 'Grupal';
                                              }

                                             ?>
                                          </td>
                                          <td>{{ $gestion->obtCategoria->valor }}</td>
                                          <td>{{ $gestion->descripcion_gestor }}</td>
                                          <td>{{ $gestion->obtGestor->valor }}</td>
                                          <td>{{ $gestion->obtMUN->valor }}</td>
                                          <td>
                                              <?php
                                                if ($gestion->fecha_atendido == null) {
                                                  echo 'Aun no es Atendida';
                                                }else {
                                                  echo $gestion->fecha_atendido;
                                                }

                                               ?>
                                          </td>
                                          <td>{{ $gestion->apoyo_otorgado }}</td>
                                          <td>
                                              <?php
                                                if ($gestion->estatus == 1) {
                                                echo 'Registrado';
                                                 }elseif($gestion->estatus == 2){
                                                   echo 'Entregada';
                                                 }elseif($gestion->estatus == 3){
                                                   echo 'En Proceso';
                                                 }elseif($gestion->estatus == 4){
                                                   echo 'Pendiente';
                                                 }elseif($gestion->estatus == 5){
                                                   echo 'Cancelada';
                                                 }

                                               ?>
                                          </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                <!--///////////// fin gestiones tabla ///////////////////-->
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_3_3" role="tabpanel" aria-labelledby="kt_tab_pane_3_3">
                                  <!--///////////// bitacora tabla ///////////////////-->
                                  <table class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col">Fecha</th>
                                          <th scope="col">Hora</th>
                                          <th scope="col">Usuario</th>
                                          <th scope="col">Ubicación Usuario</th>
                                          <th scope="col">Detalle Actividad</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($bitacora as $bita)
                                      <tr>
                                        <td>{{ $bita->fecha }}</td>
                                        <td>{{ $bita->hora }}</td>
                                        <td>{{ $bita->_Usuario->nombres }} {{ $bita->_Usuario->apellidos }}</td>
                                        <td>Sin Información</td>
                                        <td>{{ $bita->movimiento }}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                <!--///////////// fin bitacora tabla ///////////////////-->
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_4_3" role="tabpanel" aria-labelledby="kt_tab_pane_4_3">
                                    ...
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @endisset


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
              <button type="button" class="btn btn-light-primary font-weight-bold " id="bitacora_modal">Guardar</button>
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

                      <input type="hidden" name="id_ciudadano2" id="id_ciudadano2" >

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
              <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal" id="cerrar">Cerrar</button>
              <button type="button" class="btn btn-light-primary font-weight-bold" id="submitBene" >Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
<script src="/metronic/assets/js/pages/crud/forms/widgets/select2.js?v=7.0.6"></script>
<script >
var arrayFiguras = [];
var objFigura = {};

$('#estatus').select2();
$('#origen_peticion').select2();
$('#tipo_peticion').select2();
$('#categoria_peticion').select2();
$('#municipio').select2();
$('#gestor').select2();

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


    $("#cerrar").click(function(e){


       e.preventDefault();

       $('#nombre_modal').val('');
       $('#paterno_modal').val('');
       $('#materno_modal').val('');
       $('#curp_modal').val('');
       $('#fech_modal').val('');
       $('#domicilio_modal').val('');
       $('#telefono_modal').val('');
       $('#id_ciudadano_modal').val('');

       $('#ciudadano2').val('');


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
                Swal.fire("Excelente!", data.success, "success").then(function(){ location.href ="{{ url('gestiones') }}"; });
                  //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
              }


          });
        });

	});


// Funcion Mostrar valores
function set_item(id) {
	// Cambiar el valor del formulario input
	//$('#pais_id').val(opciones);

var id = id;
$.ajax({
  url: '/gestiones/create/TraerPersonas',
  type: 'POST',
  headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  data: {id:id},
  success:function(data){
    console.log(data);

    if (data == 0) {
      Swal.fire("Oh!", "Esta Persona Ya tiene Apoyos!", "warning");
    }else{
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

        $('#ciudadano2').val('');
        $('#ciudadano').val('');


      }
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


      for (var i = data.length - 1; i >= 0; i--) {

        var nombre_completo = data[i].nombre+' '+data[i].paterno+' '+data[i].materno;

         var curp =  data[i].curp;
        //
         var domicilio = data[i].nombre_asentamiento+',#'+data[i].num_ext+',C.P:'+data[i].cp;
         var telefono = data[i].numero_telefono;
        //
        $('#nombre').val(nombre_completo);
        $('#paterno').val(data[i].paterno);
        $('#materno').val(data[i].materno);
        $('#curp').val(curp);
        //$('#fech_modal').val(data[i].fecha_naciminto);
        $('#domicilio').val(domicilio);
        $('#telefono').val(telefono);
        $('#id_ciudadano').val(data[i].cve_t_ciudadano);

        $('#ciudadano').val('');





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
    $('#ciudadano2').val('');

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
            Swal.fire("Oh!", "Lo sentimos Campos Vacios!", "warning");
          }else if(estatus == 2){

            if (fecha_atendido == 0 || fecha_entregada == 0|| apoyo_otorgado == '') {
              Swal.fire("Oh!", "Lo sentimos Campos Vacios!", "warning");
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

                var ciudadano = $('#id_ciudadano').val();

                var a = parseInt(id_ciudadano);
                var b = parseInt(ciudadano);

              if (curp == '') {
                Swal.fire("Oh!", "Lo sentimos Campos Vacios!", "warning");
              }else if(a === b){
                Swal.fire("Oh!", "Ciudadano ya tiene apoyos!", "warning");
                 nombre = $('#nombre_modal').val('');
                 paterno = $('#paterno_modal').val('');
                 materno = $('#materno_modal').val('');
                 curp = $('#curp_modal').val('');
                 fecha_modal = $('#fech_modal').val('');
                 domicilio = $('#domicilio_modal').val('');
                 telefono = $('#telefono_modal').val('');
                 id_ciudadano = $('#id_ciudadano_modal').val('');
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
                  //'<td><input type="hidden" id="figura_nueva" value="'+objFigura.id+'"/>'+
                  '<td><input type="hidden" id="figura_nueva" value="'+objFigura.id+'"/>'+ objFigura.nombre +' '+objFigura.paterno +' '+objFigura.materno +'</td>'+
                  '<td>'+ objFigura.curp +'</td>'+
                  '<td>'+ objFigura.fecha_modal +'</td>'+
                  '<td>'+ objFigura.domicilio +'</td>'+
                  '<td>'+ objFigura.telefono +'</td>'+
                  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" figura_nueva_id="'+objFigura.id+'" ><i  class="fas fa-trash"></i></div></td>'
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

             ////////////////////// BITACORA /////////////////////////////////////
             $(document).on("click","#bitacora_modal",function(e){
                   //$("#btnAgregarFierro").hide();
                    e.preventDefault();


                    var comentario_bitacora = $('#comentario_bitacora').val();
                    var id = $('#id_bitacora').val();





                    if (comentario_bitacora == '') {
                    Swal.fire("Oh!", "Lo sentimos Campos Vacios!", "warning");
                  }else{
                    $.ajax({

                       type:"POST",

                       url:"/gestiones/Bitacora",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                       data:{
                         comentario_bitacora:comentario_bitacora,
                         id:id,
                       },

                        success:function(data){
                          Swal.fire("Excelente!", data.success, "success").then(function(){
                            // location.href ="{{ url('gestiones') }}";
                            $('#bitacora').modal('hide');
                            $('#comentario_bitacora').val('');
                          });
                            //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('gestiones') }}"; } );
                        }


                    });
                  }


                     //totalH = (parseInt(totalH) + parseInt(valorH));

                     //arrayHectareas.push(objHectarea);
                 });



    });

    $(document).on("click",".borrar_figura",function(e){
          var id_figura_nueva = $(this).attr('figura_nueva_id');


          e.preventDefault();
          var id = $('#figura_nueva').val();
          arrayFiguras.splice(id, 1);
          $('#id-figura-'+id_figura_nueva).remove();
      });
      ////////////////////// ELIMINAR /////////////////////////////////////////////
      $(document).on("click","#eliminarMayor",function(e){

        var id_cve_disciplina_taller = $('#disciplina_taller').val();
        var id_disciplina_taller = $(this).attr('disciplina_taller_id');

        //console.log(id_cve_disciplina_taller,id_disciplina_taller);

        e.preventDefault();
        var id = $('#fig_disciplina_taller').val();

        $('#fila_disciplina_taller'+id_disciplina_taller).remove();


        $.ajax({
          url: "/gestiones/EliminarBeneficiario",
          type: "POST",
          headers:  {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
          data: {id: id}
        });

      });

  ////////////////////////////////////////////////////////////////////////////////





</script>
@endsection
