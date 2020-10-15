@extends('layouts.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-custom gutter-b">
    	<div class="card-header flex-wrap border-0 pt-6 pb-0">
    		<div class="card-title">
    			<h3 class="card-label">
    			    Agregar Responsable
    			</h3>
    		</div>
    	</div>

    	<div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Nombre Estructura</label>
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
              <label>Buscar Nombre</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar Nombre">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label style="visibility:hidden;">Buscar Nombre</label>
              <div class="input-group">
                <a href="/ciudadanos"><i class="icon-xl fas fa-user-plus"></i></a>
              </div>
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
                <p>CURP</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>RFC</label>
              <div class="input-group">
                <p>RFC</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Nombre</label>
              <div class="input-group">
                <p>Nombre</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Apellido Paterno</label>
              <div class="input-group">
                <p>Apellido Paterno</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Apellido Materno</label>
              <div class="input-group">
                <p>Apellido Materno</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Responsabilidad</label>
              <div></div>
              <select class="custom-select form-control">
                <option selected>Selecciona una Responsabilidad</option>
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
              <label class="checkbox checkbox-single">
                    Titular&nbsp;
                    <input type="checkbox" value="" class="group-checkable">
                    <span></span>
                </label>
            </div>
          </div>
          <div class="col">

            <div class="form-group">
              <label class="checkbox checkbox-single">
                    Domicilio donde Radica es Diferente al Registrado&nbsp;
                    <input type="checkbox" value="" class="group-checkable">
                    <span></span>
                </label>
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
              <div></div>
              <select class="custom-select form-control">
                <option selected>Selecciona una Responsabilidad</option>
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
                <option selected>Selecciona una Responsabilidad</option>
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
                <option selected>Selecciona una Responsabilidad</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Localidad</label>
              <div></div>
              <select class="custom-select form-control">
                <option selected>Selecciona una Responsabilidad</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        </div>
        <label><strong>DATOS DE LOCALIZACIÓN</strong></label>
        <div class="separator separator-dashed my-8"></div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Teléfono</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Teléfono">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Correo Electrónico</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Correo Electrónico">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Redes Sociales</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Redes Sociales">
              </div>
            </div>
          </div>
        </div>
        <label><strong>DATOS INE</strong></label>
        <div class="separator separator-dashed my-8"></div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Clave de Elector</label>
              <div class="input-group">
                <p>Clave de Elector</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Sección</label>
              <div class="input-group">
                <p>Sección</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Año Vigencia</label>
              <div class="input-group">
                <p>Año Vigencia</p>
              </div>
            </div>
          </div>
          <div class="col">

            <div class="form-group">
              <br>
              <label class="checkbox checkbox-single">
                    Miembro activo del partido&nbsp;
                    <input type="checkbox" value="" class="group-checkable">
                    <span></span>
                </label>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Domicilio</label>
              <div class="input-group">
                <p>Calle,num ext,num int,colonia,cp,mpio,localidad,estado</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Redes Sociales</label>
              <div class="input-group">
                <p>Facebook : usuario</p>
                <p>Twitter : usuario</p>
                <p>Instagram : usuario</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">

          </div>
          <div class="col">
            <div class="form-group">
              <label style="visibility:hidden;">Año Vigencia</label>
              <div class="input-group">
                <!-- <button type="reset" class="btn btn-primary mr-2">Regresar</button> -->
                <a href="/estructuras/create" class="btn btn-secondary">Regresar</a>
                <button type="reset" class="btn btn-primary mr-2">Guardar</button>
              </div>
            </div>
          </div>
        </div>
        <label><strong>RESPONSABLES</strong></label>
        <div class="separator separator-dashed my-8"></div>
        <div class="row">
          <table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 978px;">
            <thead>
              <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Poligono</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 72px;" aria-label="Status: activate to sort column ascending">Cedula</th>

                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Responsable</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Puesto</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Titular</th>
                  <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 66px;" aria-label="Type: activate to sort column ascending">Acción</th>

                </tr>
              </thead>
              <tbody>
              <tr role="row" class="odd">
                <td>1019</td>
                  <td>1</td>
                  <td>Maricela</td>
                  <td>Promotor</td>
                  <td >
                    si
                   </td>
                   <td >
                     <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Acciones
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                              <a class="dropdown-item" href="">Quitar Responsable</a>
                              <a class="dropdown-item" href="">Agregar Responsable</a>

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
