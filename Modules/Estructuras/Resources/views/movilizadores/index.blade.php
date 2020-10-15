@extends('layouts.index')
@section('titulo', 'Movilizadores')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/estructuras/movilizadores" class="text-muted">Todas las Estructuras</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($estructura) ? "Editar" : "Nueva" }}</span> </li>
@endsection

@php
    $id_estructura = 10;
@endphp
@section('style')
    <link href="/metronic/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <style>
        .requerido { color: red; font-size: .7rem; }
    </style>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom example example-compact gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="flaticon-users text-primary"></i></span>
                <h3 class="card-label">{{ isset($estructura) ? "Editar movilizador " . $estructura->nombre_estructura : "Nuevo movilizador" }}</h3>
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


        <!-- Estructura inicial -->
        <form class="form" id="formMovilizadores" method="post" >
            @csrf
            <div class="card card-custom">
                <div class="card-body pb-1">


                    @include('estructuras::selector.estructura', [ 'id_estructura' => $id_estructura, 'id_responsable' => 0])



                    <br />
                    <div id="muestra_valor" style="color: red;"> Valor id_estructura </div>
                    <br />

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
                    <!-- fin row -->
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="/estructuras/movilizadores" class="btn btn-secondary">
                                <i class="flaticon2-back"></i> Cancelar
                            </a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button id="btnMuestra" class="btn btn-primary mr-2">
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
    <!--end::Card-->


@endsection

@section('script')
    @yield('script.selector')

    <script>
        $(function() {
            $('#btnMuestra').click(function(e) {
                e.preventDefault();
                let valor = $('#comboEstructura').val();

                $('#muestra_valor').html('Valor id_estructura: ' +valor);
            });
        });

    </script>
@endsection
