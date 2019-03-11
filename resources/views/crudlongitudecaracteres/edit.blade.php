@extends('layouts.app')
@section('content')

  <div class="container">
    <h2> </h2><br/>
    <form method="post" action="{{action('Coordinador\CrudDeLongitudecaracteres@update', $id)}}" >
      @csrf
      <input name="_method" type="hidden" value="PATCH">
      <div class="row">
        <div class="form-group col-lg-8">
        <label><b>Longitud (en caracteres):</b></label>

        <input type="text" class="form-control" name="valor" value="{{$longitud->valor}}">
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
  <li class="breadcrumb-item active" aria-current="page">LONGITUD DE '{{$longitud->descripcion}}'</li>
@endsection
