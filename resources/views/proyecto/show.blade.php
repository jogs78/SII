@extends('layouts.app')
@section('content')
    <div class="container">
      <div id="sucedio">
      </div>


      <form method="post" action="{{action('Investigador\ProyectoController@update', $proyecto->id)}}" enctype="multipart/form-data" id="frmproyecto">
        @csrf
        <div class="row">
          <div class="form-group col-md-12">
            <label for="nombre_ies">Convocatoria:</label>
               {{ $proyecto->convocatoria->Nombre }} (del {{ $proyecto->convocatoria->Fecha_inicio }} al {{ $proyecto->convocatoria->Fecha_fin }})
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" name="titulo" maxlength="190" value="{{$proyecto->titulo}}" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="financiado">¿Este proyecto será financiado? </label>
            <input type="radio" name="financiado" value="1" @if($proyecto->financiado == 1) checked @endif >Si</input>
            <input type="radio" name="financiado" value="0" @if($proyecto->financiado == 0) checked @endif >No</input>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="nombre_ies">Nombre de la Institución:</label>
            {{ $proyecto->nombre_ies }}
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <!-- <label for="pe">Programa Educativo:</label> -->
             Programa Educativo: {{$proyecto->programa_educativo->programa}}
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="area">Area de estudios:</label>
            {{$proyecto->area }}
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="linea">Linea de Investigación:</label>            
              <select name="linea">       
               @foreach($lineas as $linea)
                @php
                 $sel="";
                if($proyecto->linea == $linea->linea)
                  $sel = "selected";
                else
                  $sel = "";
                @endphp         
                <option {{$sel}} > {{ $linea->linea }} </option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="month" class="form-control" name="fecha_inicio" id="fecha_inicio" value="{{$proyecto->fecha_inicio}}" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="tipo_investigacion">Tipo de investigacion:</label>
              <select name="tipo_investigacion">
               @foreach($tipos as $tipo)
                @php
                 $sel="";
                if($proyecto->tipo_investigacion == $tipo->tipo)
                  $sel = "selected";
                else
                  $sel = "";
                @endphp         
                <option {{$sel}} > {{ $tipo->tipo }} </option>
               @endforeach
              </select>


          </div>
        </div>
        <div class="row">
          <input type="submit" class="btn btn-success" id="btnadd" value="Guardar">
        </div>
      </form>
    </div>
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">ACTUALIZAR LA INFORMACION BASICA DEL PROYECTO</li>
@endsection

@section('styles')
<style>
#fecha_fin {
   display: none;
}
input:invalid{
  border-color:red;
  border-width: 10px;
}
input:valid{
 border-color:blue; 
}
</style>
@endsection


