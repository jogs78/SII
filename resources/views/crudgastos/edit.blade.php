@extends('layouts.app')
@section('content')
  <div class="container">
    <form method="post" action="{{action('Coordinador\CrudGastosController@update', $id)}}">
      @csrf
      <input name="_method" type="hidden" value="PATCH">
      <div class="row">
        <div class="form-group col-10">
          <label for="name">Concepto:</label>
          <input type="text" class="form-control" name="descripcion" value="{{$gastos->descripcion}}">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-5">
          <label for="name">Partida:</label>
          <input type="number" step="1"  size="5"  min="1000" class="form-control" name="partida" value="{{$gastos->partida}}">
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
  <li class="breadcrumb-item active" aria-current="page">EDITAR EL CONCEPTO CON PARTIDA '{{$gastos->partida}}'</li>
@endsection
