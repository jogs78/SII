@extends('layouts.app')
@section('content')
  <div class="container">
    <form method="post" action="{{url('crudadscripcion')}}" enctype="multipart/form-data">

      @csrf
      <div class="row">
        <div class="form-group col-lg-10">
          <label for="name">Lugar de adscripción:</label>
          <input type="text" class="form-control" name="ies" required>
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
  <li class="breadcrumb-item active" aria-current="page">AGREGAR UN LUGAR DE ADSCRIPCION</li>
@endsection
