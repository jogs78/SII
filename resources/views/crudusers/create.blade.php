@extends('layouts.app')
@section('content')
  <div class="register-box">
      <div class="register-box-body">
          <form action="{{url('crudusers')}}" method="post" enctype="multipart/form-data">
              {!! csrf_field() !!}

              <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                  <div class="col-md-6">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                      @if ($errors->has('email'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('CVU-TenNM') }}</label>

                  <div class="col-md-6">
                      <input id="text" type="cvutecnm" class="form-control{{ $errors->has('cvutecnm') ? ' is-invalid' : '' }}" name="cvutecnm" value="{{ old('cvutecnm') }}" required>

                      @if ($errors->has('cvutecnm'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('cvutecnem') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adscripción') }}</label>

                  <div class="col-md-6">
                      <input id="text" type="adscripcion" class="form-control{{ $errors->has('adscripcion') ? ' is-invalid' : '' }}" name="adscripcion" value="{{ old('adscripcion') }}" required>

                      @if ($errors->has('adscripcion'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('adscripcion') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
               <label for="adscripcion" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                <div class="col-md-6">
                   <select  class="form-control" name="rol">
                      <option>Coordinador</option>
                      <option>Investigador</option>
                   </select>
               </div>
             </div>

              <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                      @if ($errors->has('password'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                  <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                  </div>
              </div>
              <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('REGISTRARSE') }}
                      </button>
                  </div>
              </div>
          </form>

      </div>
      <!-- /.form-box -->
  </div>
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">AGREGAR UN USUARIO AL SISTEMA</li>
@endsection
