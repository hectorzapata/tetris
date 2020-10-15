@extends('layouts.index')

@section('content')
<div class="row">
  <div class="col-md-12">
  		<!--begin::Card-->
  		<div class="card card-custom gutter-b">
  			<div class="card-header">
  				<h3 class="card-title">
  					Registro Ciudadano
  				</h3>
  			</div>

  			<!--begin::Form-->
  			<form class="form">
  				<div class="card-body">

            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Estructura</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Estructura pertenece el usuario">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Nombre del Nivel</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Nivel</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Nombre del Responsable</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Responsable</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Poligono</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Poligono</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Número de Cedula</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Número</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
            </div>
            <label><strong>DATOS GENERALES</strong></label>
  					<div class="separator separator-dashed my-8"></div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>CURP</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="CURP">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>RFC</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="RFC">
      						</div>
      					</div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Nombre</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Nombre">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Apellido Paterno</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Apellido Paterno">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Apellido Materno</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Apellido Materno">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Fecha Nacimiento</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Fecha Nacimiento">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Género</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Género</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
            </div>
            <label><strong>DATOS DEL DOMICILIO</strong></label>
  					<div class="separator separator-dashed my-8"></div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Calle</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Calle">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Número Exterior</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Número Exterior">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Número Interior</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Número Interior">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Entre Calle</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Entre Calle">
      						</div>
      					</div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Código Postal</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Código Postal">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Colonia</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Colonia">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Estado</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Estado">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Municipio</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Municipio">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Localidad</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Localidad">
      						</div>
      					</div>
              </div>
            </div>

            <label><strong>DATOS DE LOCALIZACIÓN</strong></label>
            <div class="separator separator-dashed my-8"></div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Correo Electrónico</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Correo Electrónico">
      						</div>
      					</div>
              </div>
            </div>
            <!--Telefono-->
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Teléfono</label>
      						<div style="height:10px;">
      						</div>
      					</div>
              </div>
            </div>
            <div class="row">

              <div class="col">

                <div class="form-group">
                  <label class="checkbox checkbox-single">
                        Trabajo&nbsp;
                        <input type="checkbox" value="" class="group-checkable">
                        <span></span>
                    </label>
      					</div>
              </div>
              <div class="col">

                <div class="form-group">
                  <label class="checkbox checkbox-single">
                        Casa&nbsp;
                        <input type="checkbox" value="" class="group-checkable">
                        <span></span>
                    </label>
      					</div>
              </div>
              <div class="col">

                <div class="form-group">
                  <label class="checkbox checkbox-single">
                        Movil&nbsp;
                        <input type="checkbox" value="" class="group-checkable">
                        <span></span>
                    </label>
      					</div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Número de Teléfono</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Número de Teléfono">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label style="visibility:hidden;">Nú</label>
      						<div class="input-group">
      							<button type="button" class="btn btn-primary mr-2">Agregar</button>
      						</div>
      					</div>
              </div>
            </div>
            <div class="row">
              <!--tabla -->
              <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                <thead>
                  <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Tipo</th>
                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Teléfono</th>
                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr role="row" class="odd">
                          <td>Trabajo</td>
                          <td>8342643402</td>
                          <td >
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                              <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path>
                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
                                  </g>
                                </svg>
                              </span>
                            </a>
                             <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                               <span class="svg-icon svg-icon-md">
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <rect x="0" y="0" width="24" height="24"></rect>
                                     <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>	                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                   </g>
                                 </svg>
                               </span>
                             </a>
                           </td>
                         </tr>
                       </tbody>
                    </table>


            </div>


            <!--Redes Sociales-->
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Redes Sociales</label>
      						<div style="height:10px;">
      						</div>
      					</div>
              </div>
            </div>
            <div class="row">

              <div class="col">

                <div class="form-group">
          				<label>Red Social</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona una Red Social</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>

              <div class="col" style="visibility:hidden;">

                <div class="form-group">
          				<label>Red Social</label>
          				<div></div>

          			</div>
              </div>

              <div class="col" style="visibility:hidden;">

                <div class="form-group">
          				<label>Red Social</label>
          				<div></div>

          			</div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Nombre del Usuario</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Número de Teléfono">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label style="visibility:hidden;">Nú</label>
      						<div class="input-group">
      							<button type="button" class="btn btn-primary mr-2">Agregar</button>
      						</div>
      					</div>
              </div>
            </div>
            <div class="row">
              <!--tabla -->
              <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                <thead>
                  <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Tipo</th>
                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Teléfono</th>
                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr role="row" class="odd">
                          <td>Trabajo</td>
                          <td>8342643402</td>
                          <td >
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                              <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path>
                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
                                  </g>
                                </svg>
                              </span>
                            </a>
                             <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                               <span class="svg-icon svg-icon-md">
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <rect x="0" y="0" width="24" height="24"></rect>
                                     <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>	                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                   </g>
                                 </svg>
                               </span>
                             </a>
                           </td>
                         </tr>
                       </tbody>
                    </table>


            </div>



            <label><strong>DATOS INE</strong></label>
            <div class="separator separator-dashed my-8"></div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Clave de Elector</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Clave de Elector">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Sección</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Sección">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Año Vigencia</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Año Vigencia">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Distrito Federal</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Distrito Federal</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Distrito Local</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Distrito Local</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
      						<label>Domicilio</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Domicilio">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>N° Exterior</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="N° Exterior">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>N° Interior</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="N° Interior">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>Colonia</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="Colonia">
      						</div>
      					</div>
              </div>
              <div class="col">
                <div class="form-group">
      						<label>C.P</label>
      						<div class="input-group">
      							<input type="text" class="form-control" placeholder="C.P">
      						</div>
      					</div>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
          				<label>Estado</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Estado</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>
              <div class="col">
                <div class="form-group">
          				<label>Municipio</label>
          				<div></div>
          				<select class="custom-select form-control">
          					<option selected>Selecciona un Municipio</option>
          					<option value="1">One</option>
          					<option value="2">Two</option>
          					<option value="3">Three</option>
          				</select>
          			</div>
              </div>

              <!-- tabla estructura -->

              <div class="row">
                <!--tabla -->
                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 50%;">
                  <thead>
                    <tr role="row"  >
                        <th aria-label="Status: activate to sort column ascending">Estructura</th>
                        <th aria-label="Type: activate to sort column ascending">DF</th>
                        <th aria-label="Type: activate to sort column ascending">Estado</th>
                        <th aria-label="Status: activate to sort column ascending">Región</th>
                        <th aria-label="Type: activate to sort column ascending">Coordinador Regional</th>
                        <th aria-label="Type: activate to sort column ascending">DL</th>
                        <th aria-label="Status: activate to sort column ascending">Coordinador Distrital</th>
                        <th aria-label="Type: activate to sort column ascending">Número</th>
                        <th aria-label="Type: activate to sort column ascending">Zonal</th>
                        <th aria-label="Status: activate to sort column ascending">Poligono</th>
                        <th aria-label="Type: activate to sort column ascending">Cedula</th>
                        <th aria-label="Type: activate to sort column ascending">Promotor</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="">
                            <td>CEABE</td>
                            <td>1</td>
                            <td>Tamaulipas</td>
                            <td>Reynosa</td>
                            <td>Manuel Urbina</td>
                            <td>1</td>
                            <td>Maricela</td>
                            <td>1</td>
                            <td>Fernando</td>
                            <td>109</td>
                            <td>1</td>
                            <td>Juan Perez</td>

                           </tr>
                         </tbody>
                      </table>

              </div>



            </div>


          </div>
  				<div class="card-footer">
  					<button type="reset" class="btn btn-primary mr-2">Guardar</button>
  					<button type="reset" class="btn btn-secondary">Cancelar</button>
  				</div>
  			</form>
  			<!--end::Form-->
  		</div>
  		<!--end::Card-->
    </div>
  </div>


@endsection
