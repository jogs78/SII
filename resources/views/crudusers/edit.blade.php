@extends('layouts.app')
@section('content')

<div class="container ">

      <div class="register-box-body">
        <p class="login-box-msg"style="color:blue;"><h5>Editar usuario.</h5></p>

        <form action="{{action('Coordinador\CrudUsersController@update', $id)}}" method="post">
          {!! csrf_field() !!}
          <input name="_method" type="hidden" value="PATCH">

          <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">

            <label><b>Nombre</b></label>
            <input type="text" name="name" class="form-control col-md-4" value="{{$user->name}}">
          </div>

          <div class="form-group has-feedback {{ $errors->has('cvutecnm') ? 'has-error' : '' }}">
              <label><b>CVU-TecNM</b></label>
            <input type="text" name="cvutecnm" class="form-control col-md-4" value="{{$user->cvutecnm}}">
          </div>

          <div class="form-group has-feedback {{ $errors->has('adscripcion') ? 'has-error' : '' }}">
              <label><b>Adscripcion</b></label>
            <input type="text" name="adscripcion" class="form-control col-md-4" value="{{$user->adscripcion}}">
          </div>

          <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
              <label><b>Correo electrónico</b></label>
            <input type="email" name="email" class="form-control col-md-4" value="{{$user->email}}">
          </div>

          <div class="row">
            <div class="form-group col-lg-12" style="margin-top:60px">
              <button type="submit" class="btn btn-success" style="margin-left:38px">Actualizar</button>
            </div>
          </div>
        </form>

      </div>
      <!-- /.form-box -->
  </div>

  </div>
  @endsection
 @section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">EDITANDO LOS DATOS DEL USUARIO '{{$user->name}}'</li>
@endsection
