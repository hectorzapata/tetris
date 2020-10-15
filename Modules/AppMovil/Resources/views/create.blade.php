@extends('layouts.index')
@section('titulo', 'App Movil')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/appmovil" class="text-muted">Todos los registros</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($data) ? "Editar" : "Nuevo" }}</span> </li>
@endsection
@section('style')
  <link href="/metronic/assets/css/pages/wizard/wizard-6.css?v=7.0.6" rel="stylesheet" type="text/css">
@endsection
@section('content')
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
        <h3 class="card-label">{{ isset($appmovil) ? "Editar registro " . $appmovil->id : "Nuevo registro" }}</h3>
      </div>
      <div class="card-toolbar">
        <!--begin::Button-->
        <a href="/appmovil" class="btn btn-light font-weight-bolder">
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
      <div class="d-flex flex-column-auto flex-column">
        <ul class="nav nav-tabs nav-tabs-line">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Datos INE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Datos Credencial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Datos Personales</a>
          </li>
        </ul>
        <div class="tab-content mt-5" id="myTabContent">
          <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
            <div class="row">
              <div class="col-sm-4 col-xs-12 form-group image-input image-input-outline">
                <img class="image-input-wrapper" src='data:image/jpg;base64,@isset($appmovil)
                  {{ $appmovil->ineimg }}
                @endisset' />
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Clave Elector</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($appmovil)
                    {{ $appmovil->clave }}
                  @endisset" id="curp" disabled>
                </div>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>CURP </label>
                <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="@isset($appmovil)
                  {{ $appmovil->curp }}
                @endisset" id="nombre" disabled>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Nombre </label>
                <input type="text" class="form-control" placeholder="CURP" name="curp" value="@isset($appmovil)
                  {{ $appmovil->nombre }}
                @endisset" id="curp" disabled>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Apellido Paterno</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($appmovil)
                    {{ $appmovil->apaterno }}
                  @endisset" id="curp" disabled>
                </div>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Apellido Materno </label>
                <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="@isset($appmovil)
                  {{ $appmovil->amaterno }}
                @endisset" id="nombre" disabled>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Fecha de Nacimiento</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($appmovil)
                    {{ $appmovil->fnac }}
                  @endisset" id="curp" disabled>
                </div>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Edad </label>
                <input type="text" class="form-control" placeholder="Edad" name="edad" value="@isset($appmovil)
                  {{ $appmovil->edad }}
                @endisset" id="edad" >
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Genero </label>
                <input type="text" class="form-control" placeholder="CURP" name="curp" value="@isset($appmovil)
                  {{ $appmovil->sexo }}
                @endisset" id="curp" disabled>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
            <div class="row">
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Registro </label>
                <input type="text" class="form-control" placeholder="Registro" name="aregistro" value="@isset($appmovil)
                  {{ $appmovil->aregistro }}
                @endisset" id="aregistro" >
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Folio</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Folio" name="folio" value="@isset($appmovil)
                    {{ $appmovil->folio }}
                  @endisset" id="curp" >
                </div>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Vigencia </label>
                <input type="text" class="form-control" placeholder="CURP" name="vigencia" value="@isset($appmovil)
                  {{ $appmovil->vigencia }}
                @endisset" id="vigencia" >
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Sección </label>
                <input type="text" class="form-control" placeholder="Sección" name="seccion" value="@isset($appmovil)
                  {{ $appmovil->seccion }}
                @endisset" id="seccion" >
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Localidad</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Localidad" name="localidad" value="@isset($appmovil)
                    {{ $appmovil->localidad }}
                  @endisset" id="localidad" disabled>
                </div>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Emisión </label>
                <input type="text" class="form-control" placeholder="Emisión" name="emision" value="@isset($appmovil)
                  {{ $appmovil->emision }}
                @endisset" id="emision" >
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Domicilio </label>
                <input type="text" class="form-control" placeholder="Domicilio" name="domicilio" value="@isset($appmovil)
                  {{ $appmovil->domicilio }}
                @endisset" id="domicilio" >
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Estado</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Estado" name="estado" value="@isset($appmovil)
                    {{ $appmovil->estado }}
                  @endisset" id="estado" >
                </div>
              </div>
              <div class="col-sm-4 col-xs-12 form-group">
                <label>Municipio </label>
                <input type="text" class="form-control" placeholder="Municipio" name="municipio" value="@isset($appmovil)
                  {{ $appmovil->municipio }}
                @endisset" id="municipio" >
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
            <div class="row">
              <div class="col-sm-6 col-xs-12 form-group">
                <label>Telefono </label>
                <input type="text" class="form-control" placeholder="Telefono" name="tel" value="@isset($appmovil)
                  {{ $appmovil->tel }}
                @endisset" id="tel" >
              </div>
              <div class="col-sm-6 col-xs-12 form-group">
                <label>Correo Electronico </label>
                <input type="email" class="form-control" placeholder="Correo Electronico" name="email" value="@isset($appmovil)
                  {{ $appmovil->email }}
                @endisset" id="email" >
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-xs-12 form-group">
                <label>Usuario Facebook</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="@isset($appmovil)
                    {{ $appmovil->facebook }}
                  @endisset" id="facebook" >
                </div>
              </div>
              <div class="col-sm-6 col-xs-12 form-group">
                <label>Usuario Twitter </label>
                <input type="text" class="form-control" placeholder="Twitter" name="twitter" value="@isset($appmovil)
                  {{ $appmovil->twitter }}
                @endisset" id="twitter" >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-lg-6">
          <a href="/appmovil" class="btn btn-secondary">
            <i class="flaticon2-back"></i> Cancelar
          </a>
        </div>
        <div class="col-lg-6 text-right">
          <button type="button" class="btn btn-primary mr-2" id="kt_login_signup_form_submit_button">
            <i class="flaticon2-user"></i>
            {{ isset($appmovil) ? "Modificar" : "Guardar" }}
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script >
  $(document).ready( function () {
    /////////////////////////////////////////////////
    $("#kt_login_signup_form_submit_button").click(function(e){
      e.preventDefault();
      var tel = $("input[name=tel]").val();
      var domicilio = $("input[name=domicilio]").val();
      var email = $("input[name=email]").val();
      var facebook = $("input[name=facebook]").val();
      var twitter = $("input[name=twitter]").val();
      var edad = $("input[name=edad]").val();
      var aregistro = $("input[name=aregistro]").val();
      var folio = $("input[name=folio]").val();
      var vigencia = $("input[name=vigencia]").val();
      var seccion = $("input[name=seccion]").val();
      var localidad = $("input[name=localidad]").val();
      var emision = $("input[name=emision]").val();
      var domicilio = $("input[name=domicilio]").val();
      var estado = $("input[name=estado]").val();
      var municipio = $("input[name=municipio]").val();
      $.ajax({
        type:"{{ ( isset($appmovil) ? 'PUT' : 'POST' ) }}",
        url:"{{ ( isset($appmovil) ) ? '/appmovil/' . $appmovil->cve_t_ine_app : '/appmovil/create' }}",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
          tel:tel,
          domicilio:domicilio,
          email:email,
          facebook:facebook,
          twitter:twitter,
          edad:edad,
          aregistro:aregistro,
          folio:folio,
          vigencia:vigencia,
          seccion:seccion,
          localidad:localidad,
          emision:emision,
          domicilio:domicilio,
          estado:estado,
          municipio:municipio,
        },
        success:function(data){
          Swal.fire("Excelente!", data.success, "success").then(function(){ location.href ="{{ url('appmovil') }}"; });
          //swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('appmovil') }}"; } );
        }
      });
    });
  });
  </script>
@endsection
