@extends('layouts.index')
@section('titulo', 'Registro')
@section('acciones', '')
@section('breadcumb')
  <a href='/registro'>Todos los Registros</a> > {{ isset($registro) ? "Editar" : "Nuevo" }}
@endsection
@section('style')
<link href="/metronic/assets/css/pages/wizard/wizard-6.css?v=7.0.6" rel="stylesheet" type="text/css">
<style>
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
                    <!--begin: Wizard Nav-->
                    <div class="wizard-nav pb-lg-10 pb-3 d-flex flex-column  align-items-center align-items-md-start">
                        <!--begin::Wizard Steps-->
                        <!--////////////////////////////////////////-->
                        <!-- <div class="row form-group" >
                            <div class="col-sm-6">
                                <label class="label-form w100">Selecciona Estructura</label>
                                <select class="custom-select form-control w100" id="id_estructura" name="id_estructura">
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="label-form">Dist. Federal </label>
                                <input type="text" class="form-control p-3" disabled="disabled" id="distrito_federal" value="" />
                            </div>
                            <div class="col-sm-3">
                                <label class="label-form">Estado </label>
                                <input type="text" class="form-control p-3" disabled="disabled" id="nombre_estado" value="" />
                            </div>
                        </div>

                         seleccion de valores
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="label-form w100">Nombre del nivel </label>
                                <select class="custom-select form-control w100" id="id_nivel" name="id_nivel">
                                </select>
                            </div>
                            <div class="col-sm-3" id="ctrlUno">
                            </div>
                            <div class="col-sm-3" id="ctrlDos">
                            </div>
                            <div class="col-sm-3">
                                <label class="label-form w100">Responsable </label>
                                <select class="custom-select form-control w100" id="id_responsable" name="id_responsable">
                                    <option value="0"> Seleccionar responsable </option>
                                </select>
                            </div>
                        </div>

                        <div class="spinner spinner-track spinner-primary centra-spinner" id="loading" style="display: none; margin: 10px auto !important; width: 4% !important; text-align: center !important;"></div>
                        <p style="height: 2px; "> </p>
                        <br /> -->
                        @include('estructuras::selector.estructura', [ 'id_estructura' => $id_estructura, 'id_responsable' => 0])
                          <!-- <div class="row">
                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Estructura</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" name="nombre_estructura" placeholder="Estructura pertenece el usuario" value="@isset($registro){{ $registro->nombre_estructura }}@endisset">
                                </div>
                              </div>

                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Nombre del Nivel</label>
                                <div></div>
                                <select class="custom-select form-control" name="cve_nivel">
                                  @isset($registro)
              		                 <option value="{{ $registro->cve_nivel }}">
                                     <?php
                                        if ($registro->cve_nivel == 1) {
                                          echo 'Nivel 1';
                                        }elseif($registro->cve_nivel == 2){
                                          echo 'Nivel 2';
                                        }elseif($registro->cve_nivel == 3){
                                          echo 'Nivel3';
                                        }

                                      ?>
                                   </option>
              		                 @else
              		                 <option selected>Selecciona un Nivel</option>
              		                 @endisset

                                  <option value="1">Nivel 1</option>
                                  <option value="2">Nivel 2</option>
                                  <option value="3">Nivel 3</option>
                                </select>
                              </div>
                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Nombre del Responsable</label>
                                <div></div>
                                <select class="custom-select form-control" name="cve_responsable">
                                  @isset($registro)
              		                 <option value="{{ $registro->cve_responsable }}">
                                     <?php
                                        if ($registro->cve_responsable == 1) {
                                          echo 'Manuel Murillo';
                                        }elseif($registro->cve_responsable == 2){
                                          echo 'Juan Cardenas';
                                        }elseif($registro->cve_responsable == 3){
                                          echo 'Oscar Gutierrez';
                                        }

                                      ?>
                                   </option>
              		                 @else
              		                 <option selected>Selecciona un Responsable</option>
              		                 @endisset

                                  <option value="1">Manuel Murillo</option>
                                  <option value="2">Juan Cardenas</option>
                                  <option value="3">Oscar Gutierrez</option>
                                </select>
                              </div>

                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Poligono</label>
                                <div></div>
                                <select class="custom-select form-control" name="cve_poligono">
                                  @isset($registro)
                                   <option value="{{ $registro->cve_poligono }}">
                                     <?php
                                        if ($registro->cve_poligono == 1) {
                                          echo '1234';
                                        }elseif($registro->cve_poligono == 2){
                                          echo '5432';
                                        }elseif($registro->cve_poligono == 3){
                                          echo '6754';
                                        }

                                      ?>
                                   </option>
                                   @else
                                   <option selected>Selecciona un Poligono</option>
                                   @endisset

                                  <option value="1">1234</option>
                                  <option value="2">5432</option>
                                  <option value="3">6754</option>
                                </select>
                              </div>

                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Número de Cedula</label>
                                <div></div>
                                <select class="custom-select form-control" name="cve_cedula">
                                  @isset($registro)
                                   <option value="{{ $registro->cve_cedula }}">
                                     <?php
                                        if ($registro->cve_cedula == 1) {
                                          echo '098';
                                        }elseif($registro->cve_cedula == 2){
                                          echo '099 ';
                                        }elseif($registro->cve_cedula == 3){
                                          echo '097';
                                        }

                                      ?>
                                   </option>
                                   @else
                                   <option selected>Selecciona un Número</option>
                                   @endisset

                                  <option value="1">098</option>
                                  <option value="2">099</option>
                                  <option value="3">097</option>
                                </select>
                              </div>

                          </div> -->

                          <div class="separator separator-dashed my-8"></div>

                          <div class="row">
                              <div class="col-sm-6 col-xs-12 form-group">
                                  <label>CURP </label>
                                  <input type="text" class="form-control" placeholder="CURP" name="curp" value="@isset($registro){{ $registro->curp }}@endisset" id="curp">
                                  <i class="inverted circular search link icon" id="icon-search"></i>
                                  <i class="inverted circular sync search link icon" id="icon-sync" style="display:none"></i>
                              </div>


                              <div class="col-sm-6 col-xs-12 form-group">
                                <label>Clave de Elector</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($registro){{ $registro->clave_elector }}@endisset" id="clave_elector">
                                </div>
                              </div>
                              <div class="col-sm-4 col-xs-12 form-group">
                                  <label>Nombre </label>
                                  <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="@isset($registro){{ $registro->nombre }}@endisset" id="nombre" readonly>
                              </div>
                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Apellido Paterno</label>
                                <input type="text" class="form-control" placeholder="Apellido Paterno" name="paterno" value="@isset($registro){{ $registro->paterno }}@endisset" id="paterno" readonly>
                              </div>
                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Apellido Materno</label>
                                <input type="text" class="form-control" placeholder="Apellido Materno" name="materno" value="@isset($registro){{ $registro->materno }}@endisset" id="materno" readonly>
                              </div>

                              <div class="col-sm-4 col-xs-12 form-group">
                                  <label>Fecha Nacimiento </label>
                                  <input type="text" class="form-control" placeholder="Fecha Nacimiento" name="fecha_naciminto" id="fecha_naci" value="@isset($registro){{ $registro->fecha_naciminto }}@endisset" readonly>
                              </div>

                              <div class="col-sm-4 col-xs-12 form-group">
                                <label>Género</label>
                                 <input type="text" class="form-control" placeholder="Fecha Nacimiento" name="genero" id="genero" value="@isset($registro){{ $registro->genero }}@endisset" readonly>
                              </div>

                              <div class="col-sm-4 col-xs-12 form-group">
                                  <label>RFC</label>
                                  <input type="text" class="form-control" placeholder="RFC" name="rfc" value="@isset($registro){{ $registro->rfc }}@endisset">
                              </div>

                          </div>

                        <div class="separator separator-dashed my-8"></div>
                        <!--//////////////////////////////////////// -->
                        <div class="wizard-steps d-flex flex-column flex-md-row">

                            <!--begin::Wizard Step 1 Nav-->
                            <!-- <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-wrapper pr-lg-7 pr-5">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">1</span>
                                    </div>
                                    <div class="wizard-label mr-3">
                                        <h3 class="wizard-title">
                                            DATOS GENERALES
                                        </h3>

                                    </div>
                                    <span class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"></rect>
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div> -->
                            <!--end::Wizard Step 1 Nav-->

                            <!--begin::Wizard Step 2 Nav-->
                            <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="pending">
                                <div class="wizard-wrapper pr-lg-7 pr-5">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">1</span>
                                    </div>
                                    <div class="wizard-label mr-3">
                                        <h3 class="wizard-title">
                                            DATOS DEL DOMICILIO
                                        </h3>
                                        <!-- <div class="wizard-desc">
                                            Residential address
                                        </div> -->
                                    </div>
                                    <span class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"></rect>
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <!--end::Wizard Step 2 Nav-->

                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="pending">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">2</span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            DATOS DE LOCALIZACIÓN
                                        </h3>
                                        <!-- <div class="wizard-desc">
                                            Submit form
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <!--end::Wizard Step 3 Nav-->

                            <!--begin::Wizard Step 4 Nav-->
                            <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="pending">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">3</span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            DATOS INE
                                        </h3>
                                        <!-- <div class="wizard-desc">
                                            Submit form
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <!--end::Wizard Step 4 Nav-->
                        </div>
                        <!--end::Wizard Steps-->
                    </div>
                    <!--end: Wizard Nav-->
                </div>
                <!--end::Nav-->

                <!--begin::Form-->
                <form class="px-10 fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate" id="kt_wizard_form">
                    <!--begin: Wizard Step 1-->
                    <!-- <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                    </div> -->
                    <!--end: Wizard Step 1-->

                    <!--begin: Wizard Step 2-->
                    <div class="pb-5" data-wizard-type="step-content">
                      <div class="row">
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Calle</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Calle" name="calle_domicilio"  value="@isset($registro){{ $registro->calle_domicilio }}@endisset">
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Número Exterior</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Número Exterior" name="num_ext" value="@isset($registro){{ $registro->num_ext }}@endisset">
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Número Interior</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Número Interior" name="num_int" value="@isset($registro){{ $registro->num_int }}@endisset">
                            </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Entre Calle</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Entre Calle" name="calle_ref1" value="@isset($registro){{ $registro->calle_ref1 }}@endisset">
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Código Postal</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Código Postal" name="cp" value="@isset($registro){{ $registro->cp }}@endisset" id="cp">
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Colonia</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Colonia" name="nombre_asentamiento" value="@isset($registro){{ $registro->nombre_asentamiento }}@endisset" id="nombre_asentamiento">
                            </div>
                            <!--<div class="input-group">

                              <select class="form-control colonias_ingre" name="nombre_asentamiento" >
                                @isset($registro)
                                 <option value="{{ $registro->nombre_asentamiento }}">{{ $registro->nombre_asentamiento  }}</option>
                                 @else
                                 <option selected>Selecciona una Colonia</option>
                                 @endisset
                              </select>

                            </div>-->
                          </div>
                      </div>

                      <div class="row">


                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Estado</label>
                            <div class="input-group">
                              <select class="form-control custom-select w100" name="cve_ent" id="cve_ent" data-nivel="1">
                                @isset($registro)
                                 <option value="{{ $registro->cve_ent }}">{{ $registro->domicilio_entidad }}</option>
                                 @else
                                 <option selected>Selecciona un Estado</option>
                                 @endisset

                                @foreach($entidad as $estado)
                                <option value="{{ $estado->cve_estado }}">{{ $estado->nom_estado }}</option>
                                @endforeach
                              </select>
                              <!-- <input type="text" class="form-control" placeholder="Estado" name="cve_ent" value="@isset($registro){{ $registro->cve_ent }}@endisset"> -->
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Municipio</label>
                            <div class="input-group">
                              <select class="form-control custom-select w100" name="cve_mun" id="municipios" data-nivel="2">
                                @isset($registro)
                                 <option value="{{ $registro->cve_mun }}">{{ $registro->domicilio_municipio }}</option>
                                 @else
                                 <option selected>Selecciona un Municipio</option>
                                 @endisset

                              </select>

                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Localidad</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Localidad" name="localidad" value="@isset($registro){{ $registro->localidad }}@endisset">
                            </div>
                          </div>
                      </div>

                    </div>
                    <!--end: Wizard Step 2-->

                    <!--begin: Wizard Step 3-->
                    <div class="pb-5" data-wizard-type="step-content">
                      <div class="row">
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Correo Electrónico</label>
                            <div class="input-group">
                              <input type="email" class="form-control" placeholder="Correo Electrónico" name="correo_electronico" value="@isset($registro){{ $registro->correo_electronico }}@endisset">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Tipo Teléfono</label>
                            <div></div>
                            <select class="custom-select form-control" name="tipo_telefono"  id="tipo_telefono">
                              <option selected>Selecciona un Tipo Teléfono</option>
                              <option value="1">Trabajo</option>
                              <option value="2">Casa</option>
                              <option value="3">Movil</option>
                            </select>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Número de Teléfono</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Número de Teléfono" id="telefono">
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label style="visibility:hidden;">Nú</label>
                            <div class="input-group">
                              <button type="button" class="btn btn-primary mr-2" id="agregarTelefono">Agregar</button>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="tablaTelefono" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                          <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Tipo</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Teléfono</th>
                                <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              @isset($telefonos)
                                @foreach($telefonos as $key => $tel)
                                <input type="hidden" id="objeto" value="{{ json_encode($key) }}">
                                  <tr id="filas{{ $tel->cve_t_cat_telefonos }}">
                                    <td>
                                        <?php
                                            if ($tel->cve_tipo_telefono == 1) {
                                              echo 'Trabajo';
                                            }elseif($tel->cve_tipo_telefono == 2){
                                              echo 'Casa';
                                            }elseif($tel->cve_tipo_telefono == 3){
                                              echo 'Movil';
                                            }
                                         ?>
                                    </td>
                                    <td>{{ $tel->numero_telefono }}</td>
                                    <td style=" text-align: center; "><button type="button" class="btn btn-danger" onclick="eliminarTelefono({{ $tel->cve_t_cat_telefonos }})" ><i class="fa fa-trash"></i></button></td>
                                  </tr>
                                @endforeach
                              @endisset
                            </tbody>
                        </table>
                      </div>
                      <div style="height:20px"></div>
                      <div class="row">
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Red Social</label>
                            <div></div>
                            <select class="custom-select form-control" name="tipo_red" id="tipo_red">
                              <option selected>Selecciona una Red Social</option>
                              <option value="1">Facebook</option>
                              <option value="2">Twitter</option>
                              <option value="3">Instagram</option>
                            </select>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Nombre del Usuario</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Nombre del Usuario" id="red">
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label style="visibility:hidden;">Nú</label>
                            <div class="input-group">
                              <button type="button" class="btn btn-primary mr-2" id="agregarRed">Agregar</button>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="tablaRed" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                          <thead>
                            <tr role="row">
                              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Red Social</th>
                              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Usuario</th>
                              <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            @isset($red_social)
                              @foreach($red_social as $key => $red)
                              <input type="hidden" id="objeto" value="{{ json_encode($key) }}">
                                <tr id="filas{{ $red->cve_t_cat_red_social }}">
                                  <td>
                                    <?php
                                        if ($red->cve_cat_red_social == 1) {
                                          echo 'Facebook';
                                        }elseif($red->cve_cat_red_social == 2){
                                          echo 'Twitter';
                                        }elseif($red->cve_cat_red_social == 3){
                                          echo 'Instagram';
                                        }
                                     ?>
                                  </td>
                                  <td>{{ $red->nombre_usuario }}</td>
                                  <td style=" text-align: center; "><button type="button" class="btn btn-danger" onclick="eliminarRed({{ $red->cve_t_cat_red_social }})" ><i class="fa fa-trash"></i></button></td>
                                </tr>
                              @endforeach
                            @endisset
                          </tbody>
                        </table>
                      </div>

                    </div>


                    <!--end: Wizard Step 3-->


                    <!--begin: Wizard Step 4-->
                    <div class="pb-5" data-wizard-type="step-content">
                      <div class="row">
                          <!-- <div class="col-sm-4 col-xs-12 form-group">
                            <label>Clave de Elector</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector">
                            </div>
                          </div> -->
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Sección</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Sección" name="seccion_ine" value="@isset($registro){{ $registro->seccion_ine }}@endisset" id="seccion_ine">
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Año Vigencia</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Año Vigencia" name="vigencia_ine" value="@isset($registro){{ $registro->vigencia_ine }}@endisset">
                            </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Distrito Local</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Distrito Local" name="distrito_l_ine" value="@isset($registro){{ $registro->distrito_l_ine }}@endisset" id="distrito_l_ine" disabled>
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Distrito Federal</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Distrito Federal" name="distrito_fede_ine" value="@isset($registro){{ $registro->distrito_fede_ine }}@endisset" id="distrito_fede_ine" disabled>
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Domicilio</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Domicilio" name="calle_ine" value="@isset($registro){{ $registro->calle_ine }}@endisset" id="calle_ine">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>N° Exterior</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="N° Exterior" name="num_ext_ine" value="@isset($registro){{ $registro->num_ext_ine }}@endisset" id="num_ext_ine">
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>N° Interior</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="N° Interior" name="num_int_ine" value="@isset($registro){{ $registro->num_int_ine }}@endisset" id="num_int_ine">
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>C.P</label>
                            <div class="input-group">
                              <input type="text" class="form-control " placeholder="C.P" name="cp_ine" id="cp_ine" value="@isset($registro){{ $registro->cp_ine }}@endisset">
                            </div>
                          </div>

                      </div>

                      <div class="row">
                        <div class="col-sm-4 col-xs-12 form-group">
                          <label>Colonia</label>
                          <div class="input-group">
                            <input type="text" class="form-control " placeholder="Colonia" name="colonia_ine" id="colonia_ine" value="@isset($registro){{ $registro->colonia_ine }}@endisset">


                          </div>
                          <!-- <div class="input-group">
                            <input type="text" class="form-control" placeholder="Colonia" name="colonia_ine" value="@isset($registro){{ $registro->colonia_ine }}@endisset">
                          </div> -->
                        </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Estado</label>
                            <div class="input-group">
                              <select class="form-control custom-select w100" name="estado_ine" data-nivel="1" id="estado_ine">
                                @isset($registro)
                                 <option value="{{ $registro->estado_ine }}">{{ $registro->estado_ine }}</option>
                                 @else
                                 <option selected value="0">Selecciona un Estado</option>
                                 @endisset

                                @foreach($entidad2 as $estado)
                                <option value="{{ $estado->cve_estado }}">{{ $estado->nom_estado }}</option>
                                @endforeach
                              </select>
                              <!-- <input type="text" class="form-control" placeholder="Estado" name="cve_ent" value="@isset($registro){{ $registro->cve_ent }}@endisset"> -->
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Municipio</label>
                            <div class="input-group">
                              <select class="form-control custom-select w100" name="municipio_ine" id="municipios_ine" data-nivel="2">
                                @isset($registro)
                                 <option value="{{ $registro->municipio_ine }}">{{ $registro->municipio_ine }}</option>
                                 @else
                                 <option selected value="0">Selecciona un Municipio</option>
                                 @endisset

                              </select>

                            </div>
                          </div>

                          <!--<div class="col-sm-4 col-xs-12 form-group">
                            <label>Estado</label>
                            <div></div>
                            <select class="custom-select form-control" name="estado_ine">
                              @isset($registro)
                               <option value="{{ $registro->estado_ine }}">{{ $registro->ine_entidad }}</option>
                               @else
                               <option selected>Selecciona un Estado</option>
                               @endisset
                               @foreach($entidad as $estado)
                               <option value="{{ $estado->id }}">{{ $estado->valor }}</option>
                               @endforeach
                            </select>
                          </div>
                          <div class="col-sm-4 col-xs-12 form-group">
                            <label>Municipio</label>
                            <div></div>
                            <select class="custom-select form-control" name="municipio_ine">
                              @isset($registro)
                               <option value="{{ $registro->municipio_ine }}">{{ $registro->ine_municipio }}</option>
                               @else
                               <option selected>Selecciona un Municipio</option>
                               @endisset
                               @foreach($municipio as $mun)
                               <option value="{{ $mun->id }}">{{ $mun->valor }}</option>
                               @endforeach
                            </select>
                          </div>-->
                          <input type="hidden" name="fecha_bitacora" value="<?php echo date('Y-m-d H:i:s'); ?>">
                      </div>

                    </div>
                    <!--end: Wizard Step 4-->



                    <!--begin: Wizard Actions-->
                    <div class="d-flex justify-content-between pt-7">
                        <div class="mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pr-8 pl-6 py-4 my-3 mr-3" data-wizard-type="action-prev">
                                <span class="svg-icon svg-icon-md mr-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                          <rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1"></rect>
                                          <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "></path>
                                      </g>
                                  </svg><!--end::Svg Icon-->
                                </span>
                                  Atras
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary btn-submit font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-4" data-wizard-type="action-submit" id="kt_login_signup_form_submit_button">
                                {{ isset($registro) ? "Guardar" : "Crear" }}
                                <span class="svg-icon svg-icon-md ml-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                          <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"></rect>
                                          <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                                      </g>
                                  </svg><!--end::Svg Icon-->
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-4" data-wizard-type="action-next">
                                Siguiente
                              <span class="svg-icon svg-icon-md ml-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                      <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"></rect>
                                      <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                                  </g>
                                </svg><!--end::Svg Icon-->
                              </span>
                          </button>
                        </div>
                    </div>
                    <!--end: Wizard Actions-->
                    <!--/////////////// Inicio Tab ///////////// --->

                    @isset($registro)

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
                                    @foreach($gestiones as $gestion)
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
                                          <td>Sin Información</td>
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

                    <!--////////////// fin Tab //////////////////-->
                <div></div><div></div></form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Wizard 6-->
    </div>
    <!--end::Wizard-->
</div>

<!-- Modal-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¡Ciudadano ya fue Capturado!</h5>
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
                    <label>Fecha</label>
                    <div id="fecha">

                    </div>
                  </div>
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
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
@yield('script.selector')


<!-- <script src="/metronic/assets/js/pages/custom/wizard/wizard-2.js?v=7.0.6"></script> -->

<script>


$('#cve_ent').select2();
$('#municipios').select2();
$('#tipo_telefono').select2();
$('#tipo_red').select2();
$('#estado_ine').select2();
$('#municipios_ine').select2();

    /////////////////////////////// VARIABLES //////////////////////////////////

    var arrayTelefono = [];

    var objTelefono = {};


    var arrayRed = [];

    var objRed = {};





    $(document).ready( function () {
    /////////////////////////////////////////////////
    $("select[name=cve_ent]").change(function(){



      var entidad = $("select[name=cve_ent]").val();
      //$('#municipios').prop('selectedIndex',0);
      nivel = parseInt($(this).attr('data-nivel'));
        $.ajax({

           type:"POST",

           url:"/registro/create/Entidades",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             entidad:entidad,
           },

            success:function(data){


              if (data) {


                for(i = nivel + 1; i <= 3; i++){
                  /*$('#centrosalud_value.dropdown[data-nivel="'+i+'"]').empty();
                  $('#centrosalud_value.dropdown[data-nivel="'+i+'"]').dropdown('restore default text');*/
                  $('#municipios').empty();

                }data.forEach((x) => {

                  /*$('#centrosalud_value.dropdown[data-nivel="'+(nivel + 1)+'"]').find('.menu')
                  .append(
                    "<div class='item' data-value='"+x.cve_cat_centro+"'>"+x.clave+" "+x.nombre+"</div>"
                  );*/
                  //document.getElementById("centrosalud_value").style.display = 'block';

                  $('#municipios').append('<option value="'+x.cve_mun+'">'+x.nom_mun+'</option>');

                });




              }


              /*for (var i = data.length - 1; i >= 0; i--) {

                $('#municipios').append('<option value="'+data[i].cve_mun+'">'+data[i].nom_mun+'</option>');

              }*/
            }
      });

    });
    ////////////////////////////////////////////////
    $("select[name=estado_ine]").change(function(){

      var entidad = $("select[name=estado_ine]").val();
      //$('#municipios').prop('selectedIndex',0);
      nivel = parseInt($(this).attr('data-nivel'));
        $.ajax({

           type:"POST",

           url:"/registro/create/Entidades",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             entidad:entidad,
           },

            success:function(data){


              if (data) {


                for(i = nivel + 1; i <= 3; i++){
                  /*$('#centrosalud_value.dropdown[data-nivel="'+i+'"]').empty();
                  $('#centrosalud_value.dropdown[data-nivel="'+i+'"]').dropdown('restore default text');*/
                  $('#municipios_ine').empty();

                }data.forEach((x) => {

                  /*$('#centrosalud_value.dropdown[data-nivel="'+(nivel + 1)+'"]').find('.menu')
                  .append(
                    "<div class='item' data-value='"+x.cve_cat_centro+"'>"+x.clave+" "+x.nombre+"</div>"
                  );*/
                  //document.getElementById("centrosalud_value").style.display = 'block';

                  $('#municipios_ine').append('<option value="'+x.cve_mun+'">'+x.nom_mun+'</option>');

                });




              }


              /*for (var i = data.length - 1; i >= 0; i--) {

                $('#municipios').append('<option value="'+data[i].cve_mun+'">'+data[i].nom_mun+'</option>');

              }*/
            }
      });

    });
    ///////////////////////////////////////////////////////////////////////
    /*$("#cp").change(function(){

      var cp = $("#cp").val();

      $.ajax({

         type:"GET",

         url:"/registro/create/traerColonia",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           cp:cp,
         },

          success:function(data){

            for (var i = 0; i < data.colonias.length; i++) {

              $('.colonias_ingre').append('<option value="'+data.colonias[i].id+'">'+data.colonias[i].valor+'</option>');
            }
          }


      });

    });*/

    /////////////////// CURP UNICA //////////////////////////////////////
    $("input[name=curp]").change(function(){

      var curp = $("input[name=curp]").val();

      if (curp == '') {
          Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
      }else{
        $.ajax({

           type:"GET",

           url:"/registro/create/traerCurp",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             curp:curp,
           },

            success:function(data){



                if (data.curp == curp) {

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


                $('#modal').modal('show');
                  // Swal.fire("Lo sentimos!", "Ya Existe El Ciudadano Registrado!", "warning");
                  $("input[name=curp]").val('');

                }
            }


        });
      }



    });
    /////////////////// BUSCAR CURP /////////////////////////////////////////////////////////
    $("#curp").change(function(){

      var curp = $("#curp").val();




      if (curp == '') {
          Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
      }else{


        var length = $("#curp").val().length;
        curpValida = validarCurp(curp);

        if(length == 18 && curpValida == true){


          curpFormato = $("#curp").val().toUpperCase();



          $.ajax({

             type:"POST",

             url:"/registro/create/curpBuscar",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               curp:curp,
             },

              success:function(data){

                  var obj = jQuery.parseJSON(data);
                  var curp  = obj.datos.CURP;
                  var nombre = obj.datos.nombres;
                  var apellido_paterno = obj.datos.apellido1;
                  var apellido_materno = obj.datos.apellido2;
                  var anio_nacimiento = obj.datos.fechNac;
                  var sexo = obj.datos.sexo;

                  $('#nombre').val(nombre);
                  $('#paterno').val(apellido_paterno);
                  $('#materno').val(apellido_materno);


                  $('#fecha_naci').val(anio_nacimiento);
                  $('#genero').val(sexo);

                  $('#clave_elector').val('');


              }


          });

            //return false;
        }else{


             Swal.fire("Upss!", "¡Lo sentimos Curp no valida!", "warning");

        }



      }



    });
        /////////////////// BUSCAR clave Elector /////////////////////////////////////////////////////////
    $("#seccion_ine").change(function(){
      var seccion = $("#seccion_ine").val();

        $.ajax({

                     type:"POST",

                     url:"/registro/create/Distritos",
                     headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{
                       seccion:seccion,
                     },

                      success:function(data){

                        //console.log(data == 0);

                        if (data == 0) {
                           Swal.fire("Upss!", "¡Lo sentimos No Existe la Sección!", "warning");
                           $('#distrito_fede_ine').val('');
                           $('#distrito_l_ine').val('');
                        }else{
                          for (var i = data.length - 1; i >= 0; i--) {

                            var distrito_federal = data[i].distrito_federal;
                            var distrito_local = data[i].distrito_local;

                            $('#distrito_fede_ine').val(distrito_federal);
                            $('#distrito_l_ine').val(distrito_local);



                          }
                        }

                      }


                  });

    });
    ///////////////////////// calve de elector //////////////////////////////////////////////
    $("#clave_elector").change(function(){

      var clave_elector = $("#clave_elector").val();

      if (clave_elector == '') {
          Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
      }else{




        $.ajax({

           type:"POST",

           url:"/registro/create/claveBuscar",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             clave_elector:clave_elector,
           },

            success:function(data){


               for (var i = data.length - 1; i >= 0; i--) {

                  var curp  = data[i].CURP;
                  var seccion = data[i].S;

                  var cp = data[i].CP;
                  var colonia = data[i].COLONIA;
                  var num_ext = data[i].EXT;
                  var num_int = data[i].NINT;

                  var nombre = data[i].NOMBRE;
                  var app_p = data[i].PATERNO;
                  var app_m = data[i].MATERNO;
                  var sex = data[i].SEXO;
                  var fechn = data[i].FECNAC;

                  var calle = data[i].CALLE;
                  var estado = data[i].E;
                  var municipio = data[i].M;




                  $('#curp').val(curp);
                  $('#nombre').val(nombre);
                  $('#paterno').val(app_p);
                  $('#materno').val(app_m);


                  $('#fecha_naci').val(fechn);
                  $('#genero').val(sex);

                  $('#seccion_ine').val(seccion);
                  $('#calle_ine').val(calle);
                  $('#num_ext_ine').val(num_ext);
                  $('#num_int_ine').val(num_int);
                  $('#cp_ine').val(cp);
                  $('#colonia_ine').val(colonia);



                  ////////////////// ENTIDAD Y MUNICIPIO ////////////////
                  nivel = parseInt($(this).attr('data-nivel'));
                  $.ajax({

                     type:"POST",

                     url:"/registro/create/EntidadesMunicipios",
                     headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{
                       estado:estado,
                       municipio:municipio,
                     },

                      success:function(data){

                         if (data) {

                        $("select[name=estado_ine]").val(estado);
                        $('#municipios_ine').empty();

                          for(i = nivel + 1; i <= 3; i++){

                            $('#municipios_ine').empty();

                          }data.forEach((x) => {


                            $('#municipios_ine').append('<option value="'+x.cve_mun+'">'+x.nom_mun+'</option>');

                          });




                        }

                      }


                  });
                  ///////////////// SECCCION ///////////////////////////

                  $.ajax({

                     type:"POST",

                     url:"/registro/create/Distritos",
                     headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{
                       seccion:seccion,
                     },

                      success:function(data){


                        for (var i = data.length - 1; i >= 0; i--) {
                          var distrito_federal = data[i].distrito_federal;
                          var distrito_local = data[i].distrito_local;

                          $('#distrito_fede_ine').val(distrito_federal);
                          $('#distrito_l_ine').val(distrito_local);



                        }
                      }


                  });



                }

            }


        });
      }



    });

    ///////////////////////////////////////////////////

     $(document).on("click","#agregarTelefono",function(e){
      e.preventDefault();



      var telefono = $('#telefono').val();
      var tipo_telefono = $('select[name="tipo_telefono"] option:selected').text();
      var id_telefono = $('select[name="tipo_telefono"]').val();


      if (telefono == 0  || tipo_telefono == 0) {
          Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");

     }else{

      objTelefono = {

                    telefono : $('#telefono').val(),
                    tipo_telefono: $('select[name="tipo_telefono"] option:selected').text(),
                    id_telefono : $('select[name="tipo_telefono"]').val(),

                  }


                  agregarTelefono(objTelefono);
                  arrayTelefono.push(objTelefono);

      }



    });

    $(document).on("click","#agregarRed",function(e){
     e.preventDefault();




     var red = $('#red').val();
     var tipo_red = $('select[name="tipo_red"] option:selected').text();
     var id_red = $('select[name="tipo_red"]').val();


     if (red == 0  || tipo_red == 0) {
         Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");

    }else{

     objRed = {

                   red : $('#red').val(),
                   tipo_red: $('select[name="tipo_red"] option:selected').text(),
                   id_red : $('select[name="tipo_red"]').val(),

                 }


                 agregarRed(objRed);
                 arrayRed.push(objRed);

     }



   });



    ////////////////////////////////////////////
    ////////////////////////// WIZARD /////////////////////////////////////////
    "use strict";

    // Class definition
    var KTWizard6 = function () {
    	// Base elements
    	var _wizardEl;
    	var _formEl;
    	var _wizard;
    	var _validations = [];

    	// Private functions
    	var initWizard = function () {
    		// Initialize form wizard
    		_wizard = new KTWizard(_wizardEl, {
    			startStep: 1, // initial active step number
    			clickableSteps: true  // allow step clicking
    		});

    		// Validation before going to next page
    		_wizard.on('beforeNext', function (wizard) {
    			// Don't go to the next step yet
    			_wizard.stop();

    			// Validate form
    			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
    			validator.validate().then(function (status) {

    				if (status == 'Valid') {
    					_wizard.goNext();
    					//KTUtil.scrollTop();
    				} else {
    					Swal.fire({
    						text: "Lo sentimos, parece que se han detectado algunos campos vacios. Rellene los campos.",
    						icon: "error",
    						buttonsStyling: false,
    						confirmButtonText: "De acuerdo!",
    						customClass: {
    							confirmButton: "btn font-weight-bold btn-light"
    						}
    					}).then(function () {
    					//	KTUtil.scrollTop();
    					});
    				}
    			});
    		});

    		// Change event
    		// _wizard.on('change', function (wizard) {
    		// 	KTUtil.scrollTop();
    		// });
    	}

    	var initValidation = function () {
    		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    		// Step 1
    		// _validations.push(FormValidation.formValidation(
    		// 	_formEl,
    		// 	{
    		// 		fields: {
    		// 			curp: {
    		// 				validators: {
    		// 					notEmpty: {
    		// 						message: 'Por Favor Ingrese la Curp'
    		// 					}
    		// 				}
    		// 			},
    		// 			clave_elector: {
    		// 				validators: {
    		// 					notEmpty: {
    		// 						message: 'Por Favor Ingrese la CLave Elector'
    		// 					}
    		// 				}
    		// 			},
        //       fecha_naciminto: {
    		// 				validators: {
    		// 					notEmpty: {
    		// 						message: 'Por Favor Ingrese la Fecha de Nacimiento'
    		// 					}
    		// 				}
    		// 			}
    		// 		},
    		// 		plugins: {
    		// 			trigger: new FormValidation.plugins.Trigger(),
    		// 			bootstrap: new FormValidation.plugins.Bootstrap()
    		// 		}
    		// 	}
    		// ));

    		// Step 2
    		_validations.push(FormValidation.formValidation(
    			_formEl,
    			{
    				fields: {
    					calle_domicilio: {
    						validators: {
    							notEmpty: {
    								message: 'Por favor Ingrese Calle'
    							}
    						}
    					},
              num_ext: {
								validators: {
									notEmpty: {
										message: 'Por favor Ingrese Num.Exterior'
									},
									digits: {
										message: 'No es un dígito válido'
									}
								}
							}
    				},
    				plugins: {
    					trigger: new FormValidation.plugins.Trigger(),
    					bootstrap: new FormValidation.plugins.Bootstrap()
    				}
    			}
    		));

        //Step 3//
        _validations.push(FormValidation.formValidation(
          _formEl,
          {
            fields: {
              correo_electronico: {
												validators: {
													notEmpty: {
														message: 'correo electronico es requerido'
													},
													emailAddress: {
														message: 'El valor no es una dirección de correo electrónico válida'
													}
												}
											},


          },
          plugins: {
                      trigger: new FormValidation.plugins.Trigger(),
                      bootstrap: new FormValidation.plugins.Bootstrap()
                    }
        }
        ));

        //Step 4//
        _validations.push(FormValidation.formValidation(
          _formEl,
          {
            fields: {

              seccion_ine: {
								validators: {
									notEmpty: {
										message: 'Por favor Ingresa tu Sección'
									},
									digits: {
										message: 'No es un dígito válido'
									}
								}
							},
              vigencia_ine: {
								validators: {
									notEmpty: {
										message: 'Por favor Ingresa tu Año de vigencia'
									},
									digits: {
										message: 'No es un dígito válido'
									}
								}
							},


              num_ext_ine: {
                validators: {
                  notEmpty: {
                    message: 'Por favor Ingrese Num.Exterior'
                  },
                  digits: {
                    message: 'No es un dígito válido'
                  }
                }
              },

              distrito_fede_ine: {
                validators: {
                  notEmpty: {
                    message: 'Por favor Selecciona Distrito Federal'
                  }
                }
              },
              distrito_l_ine: {
                validators: {
                  notEmpty: {
                    message: 'Por favor Selecciona Distrito Local'
                  }
                }
              },

              estado_ine: {
                validators: {
                  notEmpty: {
                    message: 'Por favor Selecciona Estado'
                  }
                }
              },
              municipio_ine: {
                validators: {
                  notEmpty: {
                    message: 'Por favor Selecciona Municipio'
                  }
                }
              }


          },      plugins: {
                  trigger: new FormValidation.plugins.Trigger(),
                  bootstrap: new FormValidation.plugins.Bootstrap()
                }
        }
        ));

      }
    	return {
    		// public functions
    		init: function () {
    			_wizardEl = KTUtil.getById('kt_wizard');
    			_formEl = KTUtil.getById('kt_wizard_form');
    			initWizard();
    			initValidation();
    		}
    	};
    }();

    jQuery(document).ready(function () {
    	KTWizard6.init();
    });





});

  /////////////////////////////////////////////////////////////////////////////////////////////////
  $(".btn-submit").click(function(e){


        e.preventDefault();

        var id_estructura = $('#comboEstructura').select2();


        console.log(id_estructura);

        var nombre_estructura = $("input[name=nombre_estructura]").val();
        var cve_nivel = $("select[name=cve_nivel]").val();
        var cve_responsable = $("select[name=cve_responsable]").val();
        var cve_poligono = $("select[name=cve_poligono]").val();
        var cve_cedula = $("select[name=cve_cedula]").val();
        var correo_electronico = $("input[name=correo_electronico]").val();
        //////////////////////////////////////////////////////////////////
        var nombre = $("input[name=nombre]").val();
        var paterno = $("input[name=paterno]").val();
        var materno = $("input[name=materno]").val();
        var rfc = $("input[name=rfc]").val();
        var curp = $("input[name=curp]").val();
        var genero = $("input[name=genero]").val();
        var fecha_naciminto = $("input[name=fecha_naciminto]").val();
        ////////////////////////////////////////////////////////////////
        var calle = $("input[name=calle_domicilio]").val();
        var num_ext = $("input[name=num_ext]").val();
        var num_int = $("input[name=num_int]").val();
        var calle_ref1 = $("input[name=calle_ref1]").val();
        var cp = $("input[name=cp]").val();
        var nombre_asentamiento = $("input[name=nombre_asentamiento]").val();
        var cve_ent = $("select[name=cve_ent]").val();
        var cve_mun = $("select[name=cve_mun]").val();
        var localidad = $("input[name=localidad]").val();

        var clave_elector = $("input[name=clave_elector]").val();
        var seccion_ine = $("input[name=seccion_ine]").val();
        var vigencia_ine = $("input[name=vigencia_ine]").val();
        var calle_ine = $("input[name=calle_ine]").val();
        var num_ext_ine = $("input[name=num_ext_ine]").val();
        var num_int_ine = $("input[name=num_int_ine]").val();
        var colonia_ine = $("input[name=colonia_ine]").val();
        var cp_ine = $("input[name=cp_ine]").val();
        var estado_ine = $("select[name=estado_ine]").val();
        var municipio_ine = $("select[name=municipio_ine]").val();

        var distrito_fede_ine = $("input[name=distrito_fede_ine]").val();
        var distrito_l_ine = $("input[name=distrito_l_ine]").val();
        var fecha_bitacora = $("input[name=fecha_bitacora]").val();

        if (seccion_ine == '' || vigencia_ine == '' || estado_ine == 0) {
          Swal.fire("Upss!", "Lo sentimos Campos Vacios!", "warning");
        }else{
          $.ajax({

             type:"{{ ( isset($registro) ? 'PUT' : 'POST' ) }}",

             url:"{{ ( isset($registro) ) ? '/registro/' . $registro->cve_t_registro_ciudadano : '/registro/create' }}",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               nombre_estructura:nombre_estructura,
               cve_nivel:cve_nivel,
               cve_responsable:cve_responsable,
               cve_poligono:cve_poligono,
               cve_cedula:cve_cedula,
               correo_electronico:correo_electronico,

               nombre:nombre,
               paterno:paterno,
               materno:materno,
               rfc:rfc,
               curp:curp,
               genero:genero,
               fecha_naciminto:fecha_naciminto,

               calle : calle,
               num_ext : num_ext,
               num_int : num_int,
               calle_ref1 : calle_ref1,
               cp : cp,
               nombre_asentamiento : nombre_asentamiento,
               cve_ent : cve_ent,
               cve_mun : cve_mun,
               localidad : localidad,

               telefonos:arrayTelefono,
               redes:arrayRed,

               clave_elector : clave_elector,
               seccion_ine : seccion_ine,
               vigencia_ine : vigencia_ine,
               calle_ine : calle_ine,
               num_ext_ine : num_ext_ine,
               num_int_ine : num_int_ine,
               colonia_ine : colonia_ine,
               cp_ine : cp_ine,
               estado_ine : estado_ine,
               municipio_ine : municipio_ine,
               distrito_fede_ine : distrito_fede_ine,
               distrito_l_ine : distrito_l_ine,
               fecha_bitacora : fecha_bitacora,
             },

              success:function(data){

                if (data.warning) {
                  Swal.fire("Excelente!", data.warning, "warning").then(function(){ });
                }else{
                  Swal.fire("Excelente!", data.success, "success").then(function(){ location.href ="{{ url('registro') }}"; });
                }

                  //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('registro') }}"; } );
              }


          });
        }







  });
  ///////////////////////////////////////////////////////////////////////////////////
  function validarCurp(campo){
        var RegExPattern = /^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$|^([a-z]{4})([0-9]{6})([a-z]{6})([a-z]{1})([0-9]{1})$/i;
        if ((campo.match(RegExPattern)) && (campo!='')) {
          return true;
        } else {
          return false;
        }
    }
  ////////////////////////////////////////////////////////////////////////////////////////////////
  var contador_telefono = 0;
  function agregarTelefono(objTelefono){
    //construccion de tabla
      var tr = '<tr class="borrar_aspc_create "  role="row" class="odd" id="filas'+contador_telefono+'">'+

      '<td>'+objTelefono.tipo_telefono+'<input type="hidden" name="id_materia[]" value="'+objTelefono.id_telefono+'" id="nvel_educativo_nombre'+contador_telefono+'"/></td>'+
      '<td>'+objTelefono.telefono+'<input type="hidden" name="id_materia[]" value="'+objTelefono.telefono+'" id="nvel_educativo_nombre'+contador_telefono+'"/></td>'+
      '<td style=" text-align: center; "><div  class="btn btn-danger" onclick="eliminarTelefono_create('+contador_telefono+')"> <i class="fa fa-trash"></i></div></td>'
      '</tr>';





      $("#tablaTelefono").append(tr);
      //limpiar campos

      $('#telefono').val('');
      $('select[name="tipo_telefono"]').val('');

   contador_telefono ++;
   //////////////////////////////////////


  }

  function eliminarTelefono_create(id) {


  arrayTelefono.splice(id,1);

    $('#filas'+id).remove();
  }


  /////////////////////////////////////////////////////////////////////////////////////
  var contador_red = 0;
  function agregarRed(objRed){
    //construccion de tabla
      var tr = '<tr class="borrar_aspc_create "  role="row" class="odd" id="filas'+contador_red+'">'+

      '<td>'+objRed.tipo_red+'<input type="hidden" name="id_materia[]" value="'+objRed.id_red+'" id="nvel_educativo_nombre'+contador_red+'"/></td>'+
      '<td>'+objRed.red+'<input type="hidden" name="id_materia[]" value="'+objRed.red+'" id="nvel_educativo_nombre'+contador_red+'"/></td>'+
      '<td style=" text-align: center; "><div  class="btn btn-danger" onclick="eliminarRed_create('+contador_red+')"> <i class="fa fa-trash"></i></div></td>'
      '</tr>';





      $("#tablaRed").append(tr);
      //limpiar campos

      $('#red').val('');
      $('select[name="tipo_red"]').val('');

   contador_red ++;
   //////////////////////////////////////


  }

  function eliminarRed_create(id) {


  arrayRed.splice(id,1);

    $('#filas'+id).remove();
  }

  /////////////////////////////// Eliminar telefono en edicion ////////////////////
        function eliminarTelefono(id) {


            var objeto = $('#objeto').val();

            eval(objeto);
            arrayTelefono = JSON.parse(objeto);


            $.ajax({
              url: "/registro/borrar_telefono",
              type: "POST",
              headers:  {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
              data: {id: id}
            });

            $('#filas'+id).remove();

        }
  /////////////////////////// Eliminar red social en edicion //////////////////////

  function eliminarRed(id) {


      var objeto = $('#objeto').val();

      eval(objeto);
      arrayRed = JSON.parse(objeto);


      $.ajax({
        url: "/registro/borrar_red",
        type: "POST",
        headers:  {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
        data: {id: id}
      });

      $('#filas'+id).remove();

  }

</script>
@endsection
