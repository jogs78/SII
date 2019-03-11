@extends('layouts.app')
@section('content')

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
    <th>CVU-TecNM</th>
    <th>Correo</th>
    <th>Rol</th>
    <th colspan="2"><center>Acciones</center></th>
  </tr>
</thead>
<tbody>
  @foreach ($users as $user)
  <tr>

    <td>{{$user->name}}</td>
    <td>{{$user->cvutecnm}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->rol}}</td>
    <td>
      <a  href="{{action('Coordinador\CrudUsersController@edit', $user->id)}}" class="btn btn-warning">Editar</a>
      <a  href="{{action('Coordinador\CrudUsersController@cambiar', $user->id)}}" class="btn btn-warning">Cambiar Password</a>

    <td>
      <form action="{{action('Coordinador\CrudUsersController@destroy', $user->id)}}" method="post">
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
  <li class="breadcrumb-item active" aria-current="page">LISTADO DE USUARIOS REGISTRADOS EN EL SISTEMA</li>
@endsection

