@extends('layouts.index')
@section('titulo', 'Gestiones')
@section('acciones', '')
@section('breadcumb')
  <a href='/gestiones'>Todas las Gestiones</a> > {{ isset($gestiones) ? "Ver" : "Nuevo" }}
@endsection
@section('style')
<link href="/metronic/assets/css/pages/wizard/wizard-6.css?v=7.0.6" rel="stylesheet" type="text/css">
<link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
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
                        <label>Representante </label>
                        <p>
                            <?php

                              if ($gestiones->representante == 1) {
                                echo 'Si';
                              }else{
                                echo 'No';
                              }

                             ?>

                        </p>
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
                          <p>@isset($persona) @foreach($persona as $person) {{ $person->nombre }} {{ $person->paterno }} {{ $person->materno }}  @endforeach @endisset</p>

                      </div>


                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>CURP</label>
                        <div class="input-group">
                          <p>@isset($persona) @foreach($persona as $person) {{ $person->curp }} @endforeach @endisset</p>

                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Domicilio </label>
                          <p>@isset($persona) @foreach($persona as $person) {{ $person->nombre_asentamiento }}, #{{ $person->num_ext }}, C.P:{{ $person->cp }} @endforeach @endisset</p>
                      </div>
                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>Telefonos</label>
                        <p>@isset($persona) @foreach($persona as $person) {{ $person->numero_telefono }} @endforeach @endisset</p>
                      </div>

                    </div>

                    <div class="separator separator-dashed my-8"></div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Origen Petición </label>
                          <p>
                            <?php
                                if ($gestiones->origen_peticion == 1) {
                                  echo 'Jornada';
                                }else{
                                  echo 'Inaguración';
                                }
                             ?>
                          </p>
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Tipo Petición</label>
                        <p>
                          <?php
                            if ($gestiones->tipo_peticion == 1) {
                              echo 'Individual';
                            }else{
                              echo 'Grupal';

                            }

                           ?>
                        </p>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Categoría </label>
                          <p>{{ $gestiones->obtCategoria->valor }}</p>
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Fecha Recepción</label>
                          <p>{{ $gestiones->fecha_recepcion }}</p>
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Fecha Atendido</label>
                        <div class="input-group">
                          <p>{{ $gestiones->fecha_atendido }}</p>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Fecha de Entrega </label>
                          <p>{{ $gestiones->fecha_entrega }}</p>
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">

                          <label>Municipio </label>
                          <p>
                            <?php
                              foreach ($municipio as $key => $value) {
                                echo $value->nom_mun;
                              }
                             ?>
                          </p>

                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Gestor</label>
                        <div class="input-group">
                          <p>{{ $gestiones->obtGestor->valor }}</p>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Procedencia del Gestor </label>
                          <p>{{ $gestiones->procedencia_gestor }}</p>
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Descripción de la gestión </label>
                          <p>{{ $gestiones->descripcion_gestor }}</p>

                      </div>


                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>Apoyo Otorgado</label>
                        <div class="input-group">
                          <p>{{ $gestiones->apoyo_otorgado }}</p>

                        </div>
                      </div>


                    </div>

                    @if($gestiones->tipo_peticion == 2)

                        <div class="separator separator-dashed my-8"></div>
                    <!-- //////////// tabla Grupal //////////////////////-->


                        <div class="d-flex justify-content-between pt-7">
                            <div class="mr-2">
                                <label>Beneficiarios</label>
                            </div>


                        </div>
                       <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                          <thead>
                              <tr>
                                  <!-- <th scope="col">Representante</th> -->
                                  <th scope="col">Nombre Beneficiario</th>
                                  <th scope="col">CURP</th>
                                  <th scope="col">Fecha Nacimiento</th>
                                  <th scope="col">Domicilio</th>
                                  <th scope="col">Telefono</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($beneficiarios as $beni)
                              <tr>

                                <td>{{ $beni->nombre }} {{ $beni->paterno }} {{ $beni->materno }}</td>
                                <td>{{ $beni->curp }}</td>
                                <td>{{ $beni->fecha_modal }}</td>
                                <td>{{ $beni->domicilio }}</td>
                                <td>{{ $beni->telefono }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>


                    @else

                    @endif



                    <!-- /////////////////////////////////////////////// -->
                    <div class="separator separator-dashed my-8"></div>

                    <div class="d-flex justify-content-between pt-7">
                        <div class="mr-2">
                          <a href="/gestiones" class="btn btn-light-primary font-weight-bolder font-size-h6 pr-8 pl-6 py-4 my-3 mr-3"> <i class="icon-xl fas fa-reply"></i>
                            Atras</a>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
