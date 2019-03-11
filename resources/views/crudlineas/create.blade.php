@extends('layouts.app')
@section('content')

  <div class="container">
    <form method="post" action="{{url('crudlineas')}}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="form-group col-lg-12">
          <label for="name">Linea:</label>
          <input type="text" class="form-control" name="linea" required>
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
  <li class="breadcrumb-item active" aria-current="page">AGREGAR LINEA DE INVESTIGACION</li>
@endsection
