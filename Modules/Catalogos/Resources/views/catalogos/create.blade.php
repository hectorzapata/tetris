@extends('layouts.index')
@section('titulo', 'Catálogos')
@section('acciones', '')
@section('breadcumb')
  <li class="breadcrumb-item item-active"><a href="/catalogos/{{ $catalogo }}/index" class="text-muted">{{ $arreglo['breadcumb'] }}</a> </li>
  <li class="breadcrumb-item"><span class="text-muted">{{ isset($data) ? "Editar" : "Nuev" . $arreglo['sexo'] }}</span> </li>
@endsection
@section('style')
@endsection
@section('content')
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon"><i class="fas fa-database text-primary"></i></span>
        <h3 class="card-label">{{ isset($data) ? "Editar " . $arreglo["label"] : "Nuev" . $arreglo['sexo']. " " . strtolower($arreglo["label"]) }}</h3>
      </div>
      <div class="card-toolbar">
        <!--begin::Button-->
        <a href="/catalogos/{{ $catalogo }}/index" class="btn btn-light font-weight-bolder">
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
      <form class="form" id="nuevoForm" method="post" action="{{ isset($data) ? '/catalogos/' . $catalogo . '/' . $data->id . '/edit' : '/catalogos/' . $catalogo . '/store' }}">
        @csrf
        <div class="card-body" style="padding-top: 0; padding-bottom: 0;">
          <div class="form-group row">
            @foreach ($arreglo["campos"] as $llave => $valor)
              @if ( $valor['form'] )
                @if ( $valor['tipo'] == "dropdown" )
                  <div class="col-lg-6" style="margin-bottom: 10px;">
                    <label>{{ $valor['label'] }}:</label>
                    <select class="form-control select2 {{ $llave }}" name="{{ $llave }}">
                      <option value=""></option>
                      @foreach ($dropdown[$llave] as $key => $value)
                        <option value="{{ $value[$valor['dropdown']['llaves'][0]] }}">{{ $value[$valor['dropdown']['llaves'][1]] }}</option>
                      @endforeach
          					</select>
                  </div>
                @else
                  <div class="col-lg-6" style="margin-bottom: 10px;">
                    <label>{{ $valor['label'] }}:</label>
                    <input type="{{ $valor['tipo'] }}" name="{{ $llave }}" class="form-control" placeholder="{{ isset($valor['placeholder']) ? $valor['placeholder'] : '' }}" value="{{ old($llave) ? old($llave) : ( isset($data) ? $data->$llave : '' ) }}"/>
                  </div>
                @endif
              @endif
            @endforeach
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-lg-6">
              <!--begin::Button-->
              <a href="/catalogos/{{ $catalogo }}/index" class="btn btn-light font-weight-bolder">
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
                Cancelar
              </a>
              <!--end::Button-->
            </div>
            <div class="col-lg-6 text-right">
              <button type="submit" class="btn btn-primary mr-2">
                <i class="flaticon2-checking"></i> Guardar
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
    FormValidation.formValidation( document.getElementById('nuevoForm'), {
      fields: {
        @foreach ($arreglo['campos'] as $key => $value)
          @if ($value['form'])
            {{ $key }}:{
              validators: {
                {!! $value['validacion'] !!}
              }
            },
          @endif
        @endforeach
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
          excluded: function(field, ele, eles) { return false; },
        }),
      }
    });
    @foreach ($arreglo["campos"] as $llave => $valor)
      @if ( $valor['form'] )
        @if ( $valor['tipo'] == "dropdown" )
          $('.form-control.select2.{{ $llave }}').select2({
      			placeholder: "{{ $valor['placeholder'] }}"
      		});
          @if ( old($llave) )
            $('.form-control.select2.{{ $llave }}').val('{{ old($llave) }}'); // Select the option with a value of '1'
            $('.form-control.select2.{{ $llave }}').trigger('change'); // Notify any JS components that the value changed
          @elseif ( isset($data) )
            $('.form-control.select2.{{ $llave }}').val('{{ $data->$llave }}'); // Select the option with a value of '1'
            $('.form-control.select2.{{ $llave }}').trigger('change'); // Notify any JS components that the value changed
          @endif
        @endif
      @endif
    @endforeach
  });
  </script>
@endsection
