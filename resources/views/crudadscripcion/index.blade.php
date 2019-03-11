@extends('layouts.app')
@section('content')
  <section class="content">
    <div class="container">

    <table class="table table-striped">
    <thead>
      <tr>
        <th>Adscripción</th>
        <th><center>Acciones</center></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($ie as $ies)
      <tr>
      <td>  {{$ies->ies}}</td>
      <td>
        {{-- href="{{action('CrudGastosController@edit', $gastos->id)}}"  --}}
        <a href="{{action('Coordinador\CrudAdscripcionController@edit', $ies->id)}}"  class="btn btn-warning">Editar</a>
      </td>
      <td>
        {{-- action="{{action('CrudEntregablesController@destroy', $entregable->id)}}"  --}}
        <form action="{{action('Coordinador\CrudAdscripcionController@destroy', $ies->id)}}" method="post">
          @csrf
          <input name="_method" type="hidden" value="DELETE">
          <button class="btn btn-danger" type="submit">Borrar</button>
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
  <li class="breadcrumb-item active" aria-current="page">ADSCRIPCIONES REGISTRADAS</li>
@endsection
