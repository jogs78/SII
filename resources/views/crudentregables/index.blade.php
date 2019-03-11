@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container">

  <table class="table table-striped">
  <thead>
    <tr>
      <th>Entregables</th>
      <th>Tipo</th>

      <th colspan="2"><center>Acciones</center></th>
    </tr>
  </thead>
  <tbody>
  @foreach ($entregables as $entregable)
    <tr>
    <td>  {{$entregable->descripcion}}</td>
    <td>{{$entregable->tipo}}</td>
    <td>
      <a href="{{action('Coordinador\CrudEntregablesController@edit', $entregable->id)}}"  class="btn btn-warning">Editar</a>
    </td>
    <td>
      <form action="{{action('Coordinador\CrudEntregablesController@destroy', $entregable->id)}}" method="post">
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
  <li class="breadcrumb-item active" aria-current="page">LISTADO DE PRODUCTOS QUE PUEDEN ENTREGAR LOS INVESTIGADORES</li>
@endsection