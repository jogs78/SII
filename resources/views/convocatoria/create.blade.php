<!-- create.blade.php -->
@extends('layouts.app')
@section("content")
    <div class="container">
      <form method="post" action="{{url('convocatoria')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="form-group col-lg-12">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="Nombre" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-4">
            <label for="email">Fecha de Inicio:</label>
            <input type="date" class="form-control" name="Fecha_inicio" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="email">Fecha de Fin:</label>
            <input type="date" class="form-control" name="Fecha_fin" required>
          </div>  
        </div>
        <div class="row">
          <div class="form-group col-lg-12" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Enviar</button>
          </div>
        </div>
      </form>
    </div>
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">AGREGAR UNA CONVOCATORIA</li>
@endsection

