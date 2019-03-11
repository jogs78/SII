@extends('layouts.app')
@section('content')
  <section class="content">
    <div class="container">

    <table class="table table-striped">
    <thead>
      <tr>
        <th>Programa.</th>
        <th>Nivel</th>
        <th colspan="2"><center>Acciones</center></th>
      </tr>
    </thead>
    <tbody>
    @foreach ( $programaeducativo as $programa)
      <tr>
      <td>  {{$programa->programa}}</td>
          <td>  {{$programa->nivel}}</td>
      <td>
    {{--  --}}
        <a href="{{action('Coordinador\CrudProgramaEducativo@edit', $programa->id)}}"class="btn btn-warning">Editar</a>
      </td>
      <td>
        {{--   --}}
        <form action="{{action('Coordinador\CrudProgramaEducativo@destroy', $programa->id)}}" method="post">
          @csrf
          <input name="_method" type="hidden" value="DELETE">
          <button class="btn btn-danger" type="submit">BORRAR</button>
        </form>
      </td>
      </tr>
    @endforeach
  </tbody>
  </table>

  </section>
  </div>
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">LISTADO DE PROGRAMAS EDUCATIVOS A LOS QUE PUEDE PERTENER UN PROYECTO</li>
@endsection