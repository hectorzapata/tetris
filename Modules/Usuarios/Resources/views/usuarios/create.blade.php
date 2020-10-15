@extends('layouts.index')
@section('titulo', 'Usuarios')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/usuarios" class="text-muted">Todos los usuarios</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($usuario) ? "Editar" : "Nuevo" }}</span> </li>
@endsection
@section('style')
@endsection
@section('content')
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
        <h3 class="card-label">{{ isset($usuario) ? "Editar Usuario " . $usuario->username : "Nuevo usuario" }}</h3>
      </div>
      <div class="card-toolbar">
        <!--begin::Button-->
        <a href="/usuarios" class="btn btn-light font-weight-bolder">
          <span class="svg-icon svg-icon-md">
            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Arrow-left.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"/>
                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/>
                <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/>
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>
          Regresar
        </a>
        <!--end::Button-->
      </div>
    </div>
    <div class="card-body">
      @include('flash::message')
      <form class="form" id="nuevoUsuario" method="post" action="{{ isset($usuario) ? '/usuarios/' . $usuario->id . '/edit' : '/usuarios/store' }}">
        @csrf
        <div class="card-body" style="padding-top: 0; padding-bottom: 0;">
          <div class="form-group row">
            <div class="col-lg-6">
              <label>Nombre:</label>
              <input type="text" name="nombres" class="form-control" placeholder="Escribe el nombre" value="{{ old('nombres') ? old('nombres') : ( isset($usuario) ? $usuario->nombres : "" ) }}"/>
            </div>
            <div class="col-lg-6">
              <label>Apellidos:</label>
              <input type="text" name="apellidos" class="form-control" placeholder="Escribe los apellidos" value="{{ old('apellidos') ? old('apellidos') : ( isset($usuario) ? $usuario->apellidos : "" ) }}"/>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-6">
              <label>Username:</label>
              <input type="text" name="username" class="form-control" placeholder="Escribe el nombre de usuario" value="{{ old('username') ? old('username') : ( isset($usuario) ? $usuario->username : "" ) }}"/>
            </div>
            <div class="col-lg-6">
              <label>Email:</label>
              <input type="email" name="email" class="form-control" placeholder="Escribe el email" value="{{ old('email') ? old('email') : ( isset($usuario) ? $usuario->email : "" ) }}"/>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-6">
              <label>Contraseña:</label>
              <input name="password" type="text" class="form-control" placeholder="Escribe la contraseña" value="{{ old('password') }}"/>
            </div>
            <div class="col-lg-6">
              <label>Confirma la contraseña:</label>
              <input name="passwordconfirm" type="text" class="form-control" placeholder="Escribe nuevamente la contraseña" value="{{ old('passwordconfirm') }}"/>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-lg-6">
              <a href="/usuarios" class="btn btn-secondary">
                <i class="flaticon2-back"></i> Cancelar
              </a>
            </div>
            <div class="col-lg-6 text-right">
              <button type="submit" class="btn btn-primary mr-2">
                <i class="flaticon2-user"></i> {{ isset($usuario) ? "Guardar" : "Crear" }}
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!--end::Card-->
@endsection
@section('script')
  <script>
  $(function() {
    FormValidation.formValidation(
      document.getElementById('nuevoUsuario'),
      {
        fields: {
          nombres: {
            validators: {
              notEmpty: {
                message: 'Por favor, escribe el nombre'
              }
            }
          },
          apellidos: {
            validators: {
              notEmpty: {
                message: 'Por favor, escribe los apellidos'
              }
            }
          },
          username: {
            validators: {
              notEmpty: {
                message: 'Por favor, escribe el nombre de usuario'
              }
            }
          },
          email: {
						validators: {
							notEmpty: {
								message: 'Por favor, escribe el email'
							},
							emailAddress: {
								message: 'Por favor, escribe un email válido'
							}
						}
					},
          password: {
						validators: {
							notEmpty: {
								message: 'Por favor, escribe una contraseña'
							}
						}
					},
          passwordconfirm: {
            validators: {
              identical: {
                compare: function() {
                  return $('input[name="password"]').val() == "" ? false : $('input[name="password"]').val();
                },
                message: 'La contraseña no coincide, por favor, confirma tu contraseña'
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          // Bootstrap Framework Integration
          bootstrap: new FormValidation.plugins.Bootstrap(),
          // Validate fields when clicking the Submit button
          submitButton: new FormValidation.plugins.SubmitButton(),
          // Submit the form when all fields are valid
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          excluded: new FormValidation.plugins.Excluded({
            excluded: function(field, ele, eles) {
              @if ( isset($usuario) )
                switch (field) {
                  case 'password':
                    return true;
                    break;
                  case 'passwordconfirm':
                    let valor = $('input[name=password]').val();
                    if ( valor == "" ) { //si no quiere actualizar contraseña, lo excluyo
                      return true;
                    }else{
                      return false;
                    }
                    break;
                  default:
                    return false;
                }
              @else
                return false;
              @endif
            },
          }),
        }
      }
    );
  });
  </script>
@endsection
