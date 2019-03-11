@extends('layouts.app')
@section('content')

  <div class="container">
      <form method="post" action="{{action('Coordinador\CrudAdscripcionController@update', $id)}}">
      @csrf
      <input name="_method" type="hidden" value="PATCH">
      <div class="row">
        <div class="form-group col-lg-12">
          <label for="name">Lugar:</label>
          <input type="text" class="form-control" name="ies" value="{{$ies->ies}}">
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
  <li class="breadcrumb-item active" aria-current="page">CAMBIANDO LA ADSCRIPCION '{{$ies->ies}}'</li>
@endsection
