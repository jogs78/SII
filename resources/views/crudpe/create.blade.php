@extends('layouts.app')
@section('content')

    <div class="container">
        <form method="post" action="{{url('crudpe')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="form-group col-lg-12">
        <label for="name">Programa:</label>
            <input type="text" class="form-control" name="programa" value="">
          <br>
        <label for="name">Nivel:</label>
            <select class="form-control" name="nivel" >
              <option value="Licenciatura" selected="selected">Licenciatura</option>
              <option value="Maestria">Maestria</option>
              <option value="Doctorado">Doctorado</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-lg-12" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Agregar</button>
          </div>
        </div>
    </form>
    </div>
  @endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">AGREGAR UN PROGRAMA EDUCATIVO AL SISTEMA</li>
@endsection
