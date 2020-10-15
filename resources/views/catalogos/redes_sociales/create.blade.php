@extends('layouts.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-custom gutter-b">
      <div class="card-header">
				<h3 class="card-title">
          @isset($redes_sociales)
          Editar Red Social
          @else
					Nueva Red Social
          @endisset
				</h3>
			</div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Nombre de Red Social</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nombre_red_social" placeholder="Nombre de Red Social">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">

          <a href="/catalogos/redes_sociales" class="btn btn-secondary">Regresar</a>
          <button type="submit" class="btn btn-primary mr-2 btn-submit">Guardar</button>

        </div>
      </div>
    </div>
</div>

<script>
	$(document).ready( function () {


	    $(".btn-submit").click(function(e){


        e.preventDefault();

        var nombre_red_social = $("input[name=nombre_red_social]").val();

        if(nombre_red_social == ''){


        	swal("Upss!", "Lo sentimos Campos Vacios", "warning");


        }else{

        	$.ajax({

	           type:"{{ ( isset($redes_sociales) ? 'PUT' : 'POST' ) }}",

	           url:"{{ ( isset($redes_sociales) ) ? '/catalogos/redes_sociales/' . $redes_sociales->id_red_social : '/catalogos/redes_sociales/create' }}",
	           headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				     },
	           data:{
	           	nombre_red_social:nombre_red_social,
	           },

	            success:function(data){
	                swal({title: "Felicidades!", text: data.success, type: "success"}, function(){ location.href ="{{ url('redes_sociales') }}"; } );
	            }


	        });

        }

  });
});
</script>
@endsection
@section('script')

@endsection
