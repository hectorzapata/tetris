@extends('layouts.index')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-custom gutter-b">
    	<div class="card-header flex-wrap border-0 pt-6 pb-0">
    		<div class="card-title">
    			<h3 class="card-label">
    			    Registro de Datos a Estructura
    			</h3>
    		</div>
    	</div>

    	<div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Nombre de la Estructura</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Nombre de la Estructura">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Distrito Federal</label>
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
              <label>Estado</label>
              <div></div>
              <select class="custom-select form-control">
                <option selected>Selecciona un Nivel</option>
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
              <label>Nombre del Padre (POLIGONO)</label>
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
              <label>Descripción (Número de CEDULA)</label>
              <div></div>
              <select class="custom-select form-control">
                <option selected>Selecciona un Nivel</option>
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
              <label>Meta <small>(Total de registros a cumplir)</small></label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Meta">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <br>
              <label class="checkbox checkbox-single">
                  Aplicar a todo el nivel&nbsp;
                  <input type="checkbox" value="" class="group-checkable">
                  <span></span>
              </label>

            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label style="visibility:hidden;">Nú</label>
              <div class="input-group">
                <button type="button" class="btn btn-primary mr-2">Guardar</button>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <!--TABLA-->
          <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
            <thead>
              <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Poligono</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Número de CEDULA</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsabilidad/Puesto</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Meta</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Acciones</th>

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
                   <td >
                    <div class="dropdown">
                         <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Acciones
                         </button>
                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                             <a class="dropdown-item" href="#">Editar</a>
                             <a class="dropdown-item" href="#">Quitar Responsable</a>
                             <a class="dropdown-item" href="/estructuras/show">Agregar Responsable</a>
                             <a class="dropdown-item"  data-toggle="modal" data-target="#exampleModal">Registrar Meta</a>
                         </div>
                     </div>
                    </td>
                 </tr>
               </tbody>
            </table>

        </div>
      </div>
      <div class="card-footer">
        <a href="/estructuras" class="btn btn-secondary">Regresar</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar la Meta de registros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>POLIGONO</label>
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
                    <label>Número CEDULA</label>
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
                    <label>Número Registros</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Meta">
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold">Guardar</button>
            </div>
        </div>
    </div>
</div>


@endsection
