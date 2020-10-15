@extends('layouts.index')
@section('titulo', 'Consulta Validación')
@section('acciones', '')
@section('breadcumb', 'Todas las Consultas Validación')
@section('style')
  <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
  <style>
  .select2-container { width: 100% !important; }
  .w100 { width: 100%;}
  </style>
@endsection
@section('content')
<div class="card card-custom">
  <div class="card-header">
    <div class="card-title">
      <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
      <h3 class="card-label">Cargar Archivo para Validación</h3>
    </div>
    <div class="card-toolbar">

    </div>
  </div>
  <div class="card-body">
    <div class="row">
    </div>
  </div>
</div>
@endsection
