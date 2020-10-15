@extends('layouts.index')
@section('titulo', 'Responsabilidades')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/estructuras/responsabilidades" class="text-muted">Todas las Responsabilidades</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($responsabilidad) ? "Editar" : "Nueva" }}</span> </li>
@endsection

@section('style')
    <style>
        .requerido { color: red; font-size: .7rem; }
    </style>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="fas fa-user-shield text-primary"></i></span>
                <h3 class="card-label">{{ isset($responsabilidad) ? "Editar responsabilidad" : "Nueva responsabilidad" }}</h3>
            </div>
            <div class="card-toolbar">
                <a href="/estructuras/responsabilidades" class="btn btn-light font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
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
            </div>
        </div>

        <div class="card-body">
            <!-- Responsabilidad inicial -->
            <div class="row form-group" style="display: block;" id="frmResponsabilidad">
                <form class="form" id="formResponsabilidad" method="post" action="{{ isset($responsabilidad) ? '/estructuras/responsabilidades/' . $responsabilidad->cve_t_estructura . '/update' : '/estructuras/responsabilidades/store' }}">
                    @csrf
                    <div class="card card-custom">
                        <div class="card-body pb-1">
                            <div class="row">
                                <input type="hidden" id="btn" value=""/>
                                <div class="col-sm-6 col-xs-12 form-group">
                                    <label>Nombre de la Responsabilidad <span class="requerido">requerido</span></label>
                                    <input type="text" class="form-control" placeholder="Nombre de la Responsabilidad" id="responsabilidad" name="responsabilidad" maxlength="200" value='@isset($responsabilidad){{$responsabilidad->responsabilidad}}@endisset'>
                                </div>
                            </div>
                            <!-- fin row -->
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="/estructuras/responsabilidades" class="btn btn-secondary">
                                        <i class="flaticon2-back"></i> Cancelar
                                    </a>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button  type="submit" class="btn btn-primary mr-2">
                                    <i class="flaticon2-gear"></i>
                                    {{ isset($responsabilidad) ? "Actualizar" : "Crear responsabilidad" }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- fin card-footer -->
                    </div>
                </form>

            </div>
            <!-- fin: form-estructura -->

        </div>
        <!-- fin card-body -->

    </div>
    <!--end::Card-->

    @include('estructuras::comun.comun')

@endsection

@section('script')
    @yield('script.comun')

    <script>
        let ruta = "/estructuras/responsabilidades";

        $(function() {

            // Responsabilidad
            FormValidation.formValidation(
                document.getElementById('formResponsabilidad'),
                {
                    fields: {
                        responsabilidad: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor, escribe el nombre de la responsabilidad'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit()
                    }
                }
            );

        });
    </script>
@endsection
