@extends('layouts.index')
@section('titulo', 'App Movil')
@section('acciones', '')
@section('breadcumb')
  <a href='/appmovil'>Todos los Registros INE</a> > {{ isset($appmovil) ? "Editar" : "Nuevo" }}
@endsection
@section('style')
<link href="/metronic/assets/css/pages/wizard/wizard-6.css?v=7.0.6" rel="stylesheet" type="text/css">
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
                      
                      <!-- Tab 1-->
                      <div class="row">
                    <div class="col-sm-4 col-xs-12 form-group image-input image-input-outline">
                        <img class="image-input-wrapper" src='data:image/jpg;base64,@isset($appmovil){{ $appmovil->ineimg }}@endisset' />
                    </div>

                         <div class="col-sm-4 col-xs-12 form-group">
                        <label>Clave Elector</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($appmovil){{ $appmovil->clave }}@endisset" id="curp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>CURP </label>
                          <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="@isset($appmovil){{ $appmovil->curp }}@endisset" id="nombre" disabled>
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Nombre </label>
                          <input type="text" class="form-control" placeholder="CURP" name="curp" value="@isset($appmovil){{ $appmovil->nombre }}@endisset" id="curp" disabled>
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Apellido Paterno</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($appmovil){{ $appmovil->apaterno }}@endisset" id="curp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Apellido Materno </label>
                          <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="@isset($appmovil){{ $appmovil->amaterno }}@endisset" id="nombre" disabled>
                      </div>
                     

                    </div>

                    <div class="row">


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Fecha de Nacimiento</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Clave de Elector" name="clave_elector" value="@isset($appmovil){{ $appmovil->fnac }}@endisset" id="curp" disabled>
                        </div>
                      </div>

                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Edad </label>
                          <input type="text" class="form-control" placeholder="Edad" name="edad" value="@isset($appmovil){{ $appmovil->edad }}@endisset" id="edad" >
                      </div>

                      
                       <div class="col-sm-4 col-xs-12 form-group">
                          <label>Genero </label>
                          <input type="text" class="form-control" placeholder="CURP" name="curp" value="@isset($appmovil){{ $appmovil->sexo }}@endisset" id="curp" disabled>
                      </div>

                 
                     

                    </div>
                      <!-- fin tab 1-->


                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                      <!--tab 2-->
                      <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Registro </label>
                          <input type="text" class="form-control" placeholder="Registro" name="aregistro" value="@isset($appmovil){{ $appmovil->aregistro }}@endisset" id="aregistro" >
                      </div>

                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Folio</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Folio" name="folio" value="@isset($appmovil){{ $appmovil->folio }}@endisset" id="curp" >
                        </div>
                      </div>

                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Vigencia </label>
                          <input type="text" class="form-control" placeholder="CURP" name="vigencia" value="@isset($appmovil){{ $appmovil->vigencia }}@endisset" id="vigencia" >
                      </div>
                      
                     

                    </div>

                    <div class="row">
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Sección </label>
                          <input type="text" class="form-control" placeholder="Sección" name="seccion" value="@isset($appmovil){{ $appmovil->seccion }}@endisset" id="seccion" >
                      </div>


                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Localidad</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Localidad" name="localidad" value="@isset($appmovil){{ $appmovil->localidad }}@endisset" id="localidad" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Emisión </label>
                          <input type="text" class="form-control" placeholder="Emisión" name="emision" value="@isset($appmovil){{ $appmovil->emision }}@endisset" id="emision" >
                      </div>
                     

                    </div>



                    <div class="row">

                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Domicilio </label>
                          <input type="text" class="form-control" placeholder="Domicilio" name="domicilio" value="@isset($appmovil){{ $appmovil->domicilio }}@endisset" id="domicilio" >
                      </div>
                     
                      <div class="col-sm-4 col-xs-12 form-group">
                        <label>Estado</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Estado" name="estado" value="@isset($appmovil){{ $appmovil->estado }}@endisset" id="estado" >
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">
                          <label>Municipio </label>
                          <input type="text" class="form-control" placeholder="Municipio" name="municipio" value="@isset($appmovil){{ $appmovil->municipio }}@endisset" id="municipio" >
                      </div>

                    </div>

                      <!-- fin tab 2 -->
                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                      <!-- tab 3-->
                    <div class="row">

                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Telefono </label>
                          <input type="text" class="form-control" placeholder="Telefono" name="tel" value="@isset($appmovil){{ $appmovil->tel }}@endisset" id="tel" >
                      </div>
                   
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Correo Electronico </label>
                          <input type="email" class="form-control" placeholder="Correo Electronico" name="email" value="@isset($appmovil){{ $appmovil->email }}@endisset" id="email" >
                      </div>


                      

                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 form-group">
                        <label>Usuario Facebook</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="@isset($appmovil){{ $appmovil->facebook }}@endisset" id="facebook" >
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 form-group">
                          <label>Usuario Twitter </label>
                          <input type="text" class="form-control" placeholder="Twitter" name="twitter" value="@isset($appmovil){{ $appmovil->twitter }}@endisset" id="twitter" >
                      </div>
                     
                    </div>

                      <!--  fin tab 3-->
                    </div>
                </div>

                  

                    


                  

                    <div class="separator separator-dashed my-8"></div>

                    <div class="d-flex justify-content-between pt-7">
                        <div class="mr-2">
                          <a href="/appmovil" class="btn btn-light-primary font-weight-bolder font-size-h6 pr-8 pl-6 py-4 my-3 mr-3">
                            <i class="icon-xl fas fa-reply"></i>
                                  Atras
                          </a>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary btn-submit font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-4"  id="kt_login_signup_form_submit_button">
                                {{ isset($appmovil) ? "Modificar" : "Guardar" }}
                               <i class="icon-xl far fa-save"></i>
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script >
	$(document).ready( function () {
		    /////////////////////////////////////////////////
        $(".btn-submit").click(function(e){


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