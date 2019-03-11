@extends('layouts.app')
@section('content')

<div class="container ">

      <div class="register-box-body">

        <form action="{{action('Investigador\PerfilController@actualizar', $id)}}" method="post">
          {!! csrf_field() !!}

          <div class="form-group">
            <label><b>{{$user->name}}</b></label>
          </div>

          <div class="form-group has-feedback {{ $errors->has('pwda') ? 'has-error' : '' }}">
              <label><b>Password anterior</b></label>
            <input type="password" name="pwda" class="form-control col-md-4" required>
          </div>


          <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
              <label><b>Password</b></label>
            <input type="password" name="password" class="form-control col-md-4" required>
          </div>

          <div class="form-group has-feedback {{ $errors->has('pwd2') ? 'has-error' : '' }}">
              <label><b>Repita el password</b></label>
            <input type="password" name="pwd2" class="form-control col-md-4" required>
          </div>

          <div class="row">
            <div class="form-group col-lg-12" style="margin-top:60px">
              <button type="submit" class="btn btn-success" style="margin-left:38px">Actualizar password</button>
            </div>
          </div>
        </form>

      </div>
      <!-- /.form-box -->
  </div>

  </div>
  @endsection
 @section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">CAMBIANDO PASSWORD A '{{$user->name}}'</li>
@endsection
@section('styles')
<style>
input:invalid{
  border-color:red;
  border-width: 10px;
}
input:valid{
 border-color:blue; 
}
</style>
@endsection


