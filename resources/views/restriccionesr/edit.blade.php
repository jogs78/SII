@extends('layouts.app')
@section('content')

  <div class="container">
    <form method="post" action="{{action('Coordinador\RestriccionesRegistroController@update', $id)}}" >
      @csrf
      <input name="_method" type="hidden" value="PATCH">
      <div class="row">
        <div class="form-group col-lg-1">
        <input type="text" class="form-control" name="valor" value="{{$restriccion->valor}}">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-12" style="margin-top:60px">
          <button type="submit" class="btn btn-success" style="margin-left:38px">Actualizar</button>
        </div>
      </div>
      </div>

    </form>
  @endsection
 @section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">CANTIDAD DE '{{$restriccion->descripcion}}'</li>
@endsection
