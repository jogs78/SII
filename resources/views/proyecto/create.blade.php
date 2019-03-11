@extends('layouts.app')
@section('content')
    <div class="container">
      <div id="sucedio">
      </div>
      <form method="post" action="{{url('proyecto')}}" enctype="multipart/form-data" id="frmproyecto">
        @csrf
        <div class="row">
          <div class="form-group col-md-12">
            <label for="nombre_ies">Convocatoria:</label>
              <select name="convocatoria_id">
               @foreach($convocatorias as $convocatoria)
                 <option value="{{$convocatoria->id}}"> {{ $convocatoria->Nombre }} (del {{ $convocatoria->Fecha_inicio }} al {{ $convocatoria->Fecha_fin }})</option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" name="titulo" maxlength="190" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="financiado">¿Este proyecto será financiado? </label>
            <input type="radio" name="financiado" value="1">Si</input>
            <input type="radio" name="financiado" value="0" checked>No</input>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="nombre_ies">Nombre de la Institución:</label>
              <select name="nombre_ies">
               @foreach($ies as $ie)
                 <option > {{ $ie->ies }} </option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <!-- <label for="pe">Programa Educativo:</label> -->
             Programa Educativo:
              <select name="pe">
               @foreach($pes as $pe)
                 <option value="{{$pe->id}}"> {{$pe->programa}} </option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="area">Area de estudios:</label>
              <select name="area">
               @foreach($areas as $area)
                 <option> {{ $area->area }} </option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="linea">Linea de Investigación:</label>
              <select name="linea">
               @foreach($lineas as $linea)
                 <option > {{ $linea->linea }} </option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="month" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
          </div>
          <div class="form-group col-md-6" id="fecha_fin">
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" class="form-control" name="fecha_fin" >
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="tipo_investigacion">Tipo de investigacion:</label>
              <select name="tipo_investigacion">
               @foreach($tipos as $tipo)
                 <option> {{ $tipo->tipo }} </option>
               @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <button type="button" class="btn btn-success" id="btnadd">Guardar</button>
        </div>
      </form>
    </div>
@endsection

@section('sctipts')
<script language="javascript">
  $(document).ready(function(){
    $("#btnadd").click(agregar);    
/*
    $("#entregables-list tbody").on("click", ".btndel" , eliminar);
    $('#descripcion').on('input', marcar);
*/
  });       
</script>
<script src="{{asset('js/proyectos.js')}}"></script>
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">AGREGAR UN PROYECTO</li>
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


