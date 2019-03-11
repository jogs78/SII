@extends('layouts.app')
@section('content')
  <section class="content">
    <div class="container">

    <table class="table table-striped">
    <thead>
      <tr>
        <th>Tipos de investigacio</th>
        <th colspan="2"><center>Acciones</center></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($tipos as $tipo)
      <tr>
      <td>  {{$tipo->tipo}}</td>
      <td>
        {{-- href="{{action('CrudGastosController@edit', $gastos->id)}}"  --}}
        <a href="{{action('Coordinador\CrudInvestigacionsController@edit', $tipo->id)}}"     class="btn btn-warning">Editar</a>
      </td>
      <td>
        {{-- action="{{action('CrudEntregablesController@destroy', $entregable->id)}}"  --}}
        <form action="{{action('Coordinador\CrudInvestigacionsController@destroy', $tipo->id)}}"  method="post">
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
  <li class="breadcrumb-item active" aria-current="page">TIPOS DE INVESTIGACION REGISTRADOS EN EL SISTEMA</li>
@endsection