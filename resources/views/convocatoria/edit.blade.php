<!-- edit.blade.php -->
@extends('layouts.app')
@section("content")
    <div class="container">
        <form method="post" action="{{action('Coordinador\ConvocatoriaController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="form-group col-lg-12">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="Nombre" value="{{$convocatoria->Nombre}}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-4">
            <label for="email">Fecha de Inicio:</label>
            <input type="date" class="form-control" name="Fecha_inicio" value="{{$convocatoria->Fecha_inicio}}">
          </div>
          <div class="form-group col-lg-4">
            <label for="email">Fecha de Fin:</label>
            <input type="date" class="form-control" name="Fecha_fin" value="{{$convocatoria->Fecha_fin}}">
          </div>  
        </div>
        <div class="row">
          <div class="form-group col-lg-12" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
 @endsection
 @section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">EDITAR LA CONVOCATORIA '{{$convocatoria->Nombre}}'</li>
@endsection
