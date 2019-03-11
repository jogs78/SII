@extends('layouts.app')
@section('content')


    <div class="container">
        <form method="post" action="{{action('Coordinador\CrudLineasController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="form-group col-lg-12">
        <label for="name">Actualizar linea:</label>
            <input type="text" class="form-control" name="linea" value="{{$linea->linea}}">
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
  <li class="breadcrumb-item active" aria-current="page">EDITANDO LINEA DE INVESTIGACION '{{$linea->linea}}'</li>
@endsection

