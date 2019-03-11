<!-- index.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Fecha de creacion</th>
        <th colspan="2">Acciones</th>
      </tr>
    </thead>
    <tbody>      
      @foreach($proyectos as $proyecto)
      <tr>
        <td>{{$proyecto['id']}}</td>
        <td>{{$proyecto['titulo']}}</td>        
        <td>{{$proyecto['fecha_elaboracion']}}</td>        
        <td>
          <a href="{{action('Investigador\ProyectoController@edit', $proyecto['id'])}}" class="btn btn-primary">Editar</a>
          <a href="{{action('Investigador\DatosController@edit', $proyecto['id'])}}" class="btn btn-warning">Nombres</a>
        <td>
          <form action="{{action('Investigador\ProyectoController@destroy', $proyecto['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Borrar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <a href="/proyecto/create" class="btn btn-primary">Agregar</a>
  </div>
@endsection