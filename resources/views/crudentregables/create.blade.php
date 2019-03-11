@extends('layouts.app')
@section('content')

  <div class="container">
    
    <form method="post" action="{{url('crudentregables')}}" enctype="multipart/form-data">

      @csrf
      <div class="row">
        <div class="form-group col-lg-12">
          <label for="name">Descripcion:</label>
          <input type="text" class="form-control" name="descripcion" required>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-12">
          <label for="name">Tipo:</label>
          <select class="form-control" name="tipo">
            <option value="ACADEMICO">ACADEMICO</option>
            <option value="HUMANO" selected="selected">HUMANO</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-12" style="margin-top:60px">
          <button type="submit" class="btn btn-success" style="margin-left:38px">Agregar</button>
        </div>
      </div>

    </form>
  @endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">PRODUCTOS QUE PUEDEN ENTREGAR LOS INVESTIGADORES</li>
@endsection
