@extends('layouts.index')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-custom gutter-b">
    	<div class="card-header flex-wrap border-0 pt-6 pb-0">
    		<div class="card-title">
    			<h3 class="card-label">
    			    Lista de Estructuras NO
    			</h3>
    		</div>
    	</div>

    	<div class="card-body">
        <div class="row">
          <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
            <thead>
              <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Nombre de Estructura</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Descripción</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">DF</th>
                </tr>
              </thead>
              <tbody>
                  <tr role="row" class="odd">
                      <td>CEABE</td>
                      <td>Contenido de Ceabe</td>
                      <td>2</td>


                     </tr>
                  <tr>
                    <td colspan="3">
                      <label>Nivel-Descripción</label>
                      <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionExample7">
                      	<div class="card">
                      		<div class="card-header" id="headingOne7">
                      			<div class="card-title" data-toggle="collapse" data-target="#collapseOne7">
                      				<span class="svg-icon svg-icon-primary">
                      					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      							<polygon points="0 0 24 0 24 24 0 24"></polygon>
                      							<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                      							<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      						</g>
                      					</svg>
                      				</span>
                      				<div class="card-label pl-4">1 Región</div>

                      			</div>
                      		</div>
                      		<div id="collapseOne7" class="collapse show" data-parent="#accordionExample7">
                      			<div class="card-body pl-12">
                              <!--tabla 1-->
                              <div class="row">
                                <a href="/estructuras/create" class="btn btn-light-primary font-weight-bolder btn-sm">
                                    Nuevo
                                </a>
                              </div>
                              <br>
                              <div class="row">
                                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                                  <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">DF</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Región</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsabilidad</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Meta</th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd">
                                        <td>2</td>
                                        <td>Reynosa</td>
                                        <td>Manuel Urbina</td>
                                        <td>Coordinador</td>
                                        <td >

                                         </td>
                                       </tr>
                                     </tbody>
                                  </table>
                              </div>
                      			</div>
                      		</div>
                      	</div>
                      	<div class="card">
                      		<div class="card-header" id="headingTwo7">
                      			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo7">
                      				<span class="svg-icon svg-icon-primary">
                      					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      							<polygon points="0 0 24 0 24 24 0 24"></polygon>
                      							<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                      							<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      						</g>
                      					</svg>
                      				</span>
                      				<div class="card-label pl-4">2 DL</div>
                      			</div>
                      		</div>
                      		<div id="collapseTwo7" class="collapse" data-parent="#accordionExample7">
                      			<div class="card-body pl-12">
                      				<!--tabla 2-->
                              <div class="row">
                                <a href="/estructuras/create" class="btn btn-light-primary font-weight-bolder btn-sm">
                                    Nuevo
                                </a>
                              </div>
                              <br>
                              <div class="row">
                                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                                  <thead>
                                    <tr role="row">
                                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Región</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">DF</th>

                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsabilidad</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Meta</th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd">
                                      <td>Reynosa</td>
                                        <td>2</td>

                                        <td>Maricela</td>
                                        <td>Coordinador Distrital</td>
                                        <td >

                                         </td>
                                       </tr>
                                     </tbody>
                                  </table>
                              </div>
                      			</div>
                      		</div>
                      	</div>
                      	<div class="card">
                      		<div class="card-header" id="headingThree7">
                      			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree7">
                      				<span class="svg-icon svg-icon-primary">
                      					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      							<polygon points="0 0 24 0 24 24 0 24"></polygon>
                      							<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                      							<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      						</g>
                      					</svg>
                      				</span>
                      				<div class="card-label pl-4">3 Número</div>
                      			</div>
                      		</div>
                      		<div id="collapseThree7" class="collapse" data-parent="#accordionExample7">
                      			<div class="card-body pl-12">
                      				<!--tabla 3-->
                              <div class="row">
                                <a href="/estructuras/create" class="btn btn-light-primary font-weight-bolder btn-sm">
                                    Nuevo
                                </a>
                              </div>
                              <br>
                              <div class="row">
                                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                                  <thead>
                                    <tr role="row">
                                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Región</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Número</th>

                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsabilidad</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Meta</th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd">
                                      <td>Reynosa</td>
                                        <td>2</td>

                                        <td>Maricela</td>
                                        <td>Coordinador Distrital</td>
                                        <td >

                                         </td>
                                       </tr>
                                     </tbody>
                                  </table>
                              </div>
                      			</div>
                      		</div>
                      	</div>
                        <div class="card">
                      		<div class="card-header" id="headingfour7">
                      			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapsefour7">
                      				<span class="svg-icon svg-icon-primary">
                      					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      							<polygon points="0 0 24 0 24 24 0 24"></polygon>
                      							<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                      							<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      						</g>
                      					</svg>
                      				</span>
                      				<div class="card-label pl-4">4 Poligono</div>
                      			</div>
                      		</div>
                      		<div id="collapsefour7" class="collapse" data-parent="#accordionExample7">
                      			<div class="card-body pl-12">
                      				<!--tabla 4-->
                              <div class="row">
                                <a href="/estructuras/create" class="btn btn-light-primary font-weight-bolder btn-sm">
                                    Nuevo
                                </a>
                              </div>
                              <br>
                              <div class="row">
                                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                                  <thead>
                                    <tr role="row">
                                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Número</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Poligono</th>

                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsabilidad</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Meta</th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd">
                                      <td>Reynosa</td>
                                        <td>2</td>

                                        <td>Maricela</td>
                                        <td>Coordinador Distrital</td>
                                        <td >

                                         </td>
                                       </tr>
                                     </tbody>
                                  </table>
                              </div>
                      			</div>
                      		</div>
                      	</div>
                        <div class="card">
                      		<div class="card-header" id="headingfive7">
                      			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapsefive7">
                      				<span class="svg-icon svg-icon-primary">
                      					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      							<polygon points="0 0 24 0 24 24 0 24"></polygon>
                      							<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                      							<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      						</g>
                      					</svg>
                      				</span>
                      				<div class="card-label pl-4">5 Número de Cedula</div>
                      			</div>
                      		</div>
                      		<div id="collapsefive7" class="collapse" data-parent="#accordionExample7">
                      			<div class="card-body pl-12">
                      				<!--tabla 5-->
                              <div class="row">
                                <a href="/estructuras/create" class="btn btn-light-primary font-weight-bolder btn-sm">
                                    Nuevo
                                </a>
                              </div>
                              <br>
                              <div class="row">
                                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
                                  <thead>
                                    <tr role="row">
                                      <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Poligono</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Número de Cedula</th>

                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsabilidad</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Meta</th>

                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd">
                                      <td>Reynosa</td>
                                        <td>2</td>

                                        <td>Maricela</td>
                                        <td>Coordinador Distrital</td>
                                        <td >
                                          120
                                         </td>
                                       </tr>
                                     </tbody>
                                  </table>
                              </div>
                      			</div>
                      		</div>
                      	</div>

                      </div>
                    </td>

                  </tr>

                   </tbody>
                </table>

        </div>

    	</div>
    </div>
  </div>
</div>
@endsection
