<!-- index.blade.php -->
@extends('layouts.app')
@section("content")
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br/>
     @endif
    @if (\Session::has('error'))
      <div class="alert alert-danger">
        <p>{{ \Session::get('error') }}</p>
      </div><br/>
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th colspan="2"><center>Acciones</center></th>
      </tr>
    </thead>
    <tbody>
      @foreach($convocatorias as $convocatoria)
      <tr>
        <td>{{$convocatoria['Nombre']}}</td>
        <td>{{$convocatoria['Fecha_inicio']}}</td>
        <td>{{$convocatoria['Fecha_fin']}}</td>
        <td>
          <a href="{{action('Coordinador\ConvocatoriaController@edit', $convocatoria['id'])}}" class="btn btn-warning">Editar</a>
        <td>
          <form action="{{action('Coordinador\ConvocatoriaController@destroy', $convocatoria['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Borrar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">LISTADO DE CONVOCATORIAS</li>
@endsection
