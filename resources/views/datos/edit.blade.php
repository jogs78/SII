<!-- edit.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
      <h2>Editando el proyecto: {{$proyecto}} de la convocatoria {{ $convocatoria  }} </h2><br  />
        <form method="post" action="{{action('Investigador\DatosController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Nombre Institucion:</label>
            <input type="text" class="form-control" name="nombrei" value="{{$Datos->nombre_institucion}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="email">Nombre Programa Educativo</label>
              <input type="text" class="form-control" name="nombrep" value="{{$Datos->nombre_programa_educativo}}">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
@endsection