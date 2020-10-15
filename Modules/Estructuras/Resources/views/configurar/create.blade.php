@extends('layouts.index')
@section('titulo', 'Configurar estructura')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/estructuras/configurar" class="text-muted">Todas las Estructuras</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($estructura) ? "Editar" : "Nueva" }}</span> </li>
@endsection

@section('style')
    <link href="/metronic/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <style>
        .requerido { color: red; font-size: .7rem; }
    </style>
@endsection

@section('content')
    @include('flash::message')


    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon2-gear text-primary"></i></span>
                <h3 class="card-label">{{ isset($estructura) ? "Editar estructura " . $estructura->nombre_estructura : "Nueva estructura" }}</h3>
            </div>
            <div class="card-toolbar">
                <a href="/estructuras/configurar" class="btn btn-light font-weight-bolder">
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
            <!-- Estructura inicial -->
            <div class="row form-group" style="display: block;" id="frmEstructura">
                <form class="form" id="formEstructura" method="post" action="{{ isset($estructura) ? '/estructuras/configurar/' . $estructura->cve_t_estructura . '/update' : '/estructuras/configurar/store' }}">
                    @csrf
                    <div class="card card-custom">
                        <div class="card-body pb-1">
                            <div class="row">
                                <input type="hidden" id="btn" value=""/>
                                <div class="col-sm-6 col-xs-12 form-group">
                                    <label>Nombre de la Estructura <span class="requerido">requerido</span></label>
                                    <input type="text" class="form-control" placeholder="Nombre de la Estructura" id="nombre_estructura" name="nombre_estructura" maxlength="200" value='@isset($estructura){{$estructura->nombre_estructura}}@endisset'>
                                </div>

                                <div class="col-sm-6 col-xs-12 form-group">
                                    <label>Descripción <span class="requerido">requerido</span></label>
                                    <textarea class="form-control" rows="3" placeholder="Descripción de la Estructura" id="descripcion" name="descripcion" >@isset($estructura){{$estructura->descripcion}}@endisset</textarea>
                                </div>

                                <div class="col-sm-6 col-xs-6 form-group">
                                    <label>Estado  <span class="requerido">requerido</span></label>
                                    <select class="custom-select form-control" id="cve_estado" name="cve_estado">
                                        @isset($estados)
                                        @foreach($estados as $key => $value)
                                        <option value="{{$value->cve_estado}}">{{$value->nom_estado}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col-sm-6 col-xs-6 form-group">
                                    <label>Distrito Federal  <span class="requerido">requerido</span></label>
                                    <select class="custom-select form-control" id="distrito_federal" name="distrito_federal">
                                        <option value="0">Ningún distrito... </option>
                                    </select>
                                </div>

                            </div>
                            <!-- fin row -->
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="/estructuras/configurar" class="btn btn-secondary">
                                        <i class="flaticon2-back"></i> Cancelar
                                    </a>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button  type="submit" class="btn btn-primary mr-2">
                                    <i class="flaticon2-gear"></i>
                                    {{ isset($estructura) ? "Actualizar" : "Crear estructura" }}
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
        let distrito_federal = 0;
        let ruta = "/estructuras/configurar";

        $(function() {
            $("#cve_estado").select2({ minimumResultsForSearch: 10 });
            $("#distrito_federal").select2({ minimumResultsForSearch: 10 });
            $("#cve_estado").val(28).trigger('change', true);

            @isset($estructura)
                let estructura = @JSON($estructura);
                distrito_federal = estructura.distrito_federal;
                $("#cve_estado").val(estructura.cve_estado).trigger('change', true);

                llenaDistritos (estructura.cve_estado, 1, estructura.distrito_federal);
                listaNiveles (estructura.cve_t_estructura, 1);
            @else
            llenaDistritos (28, 1, 0);
            @endisset

            $("#cve_estado").change(function () {
                llenaDistritos (this.value, 1, 0);
            });


            // Estructura
            FormValidation.formValidation(
                document.getElementById('formEstructura'),
                {
                    fields: {
                        nombre_estructura: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor, escribe el nombre de la estructura'
                                }
                            }
                        },
                        descripcion: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor, escribe la descripción'
                                }
                            }
                        },
                        distrito_federal: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor, selecciona el distrito'
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


        function llenaDistritos (id, cual = 1, df) {
            $('#distrito_federal').addClass('loading');
            $.ajax({
                url:  '/estructuras/lista_distritos/' + id +'/' +cual,
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                type: 'get'
            })
            .always(function(r) {
                $('#distrito_federal').removeClass('loading');
                $('#distrito_federal').html('');

                if (r.federales.length > 0) {
                    arrDistritos = r.federales;
                    selected = false;
                    arrDistritos.forEach (function(ele) {
                        if(df > 0)
                            selected = (ele.cve_cat_distritofederal == df) ? true : false;

                        newOption   = new Option(ele.cve_cat_distritofederal +' - ' +ele.cabecera, ele.cve_cat_distritofederal, selected, selected);
                        $('#distrito_federal').append(newOption).trigger('change');
                    });
                }
                else {
                    newOption   = new Option('Ningún distrito...', 0, false, false);
                    $('#distrito_federal').append(newOption).trigger('change');
                }
            });
        }

    </script>
@endsection
