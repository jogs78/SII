<!-- index.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table id="entregables-list" class="table table-striped">
    <thead>
      <tr>
        <th>TIPO</th>
        <th>CANTIDAD</th>
        <th>DESCRIPCION</th>
        <th>ELIMINAR</th>
      </tr>
    </thead>
    <tbody>      
      @foreach($entregables as $entregable)
      <tr id="entregable_{{$entregable->id}}" >
        <td>{{$entregable->tipo}}</td>
        <td>{{$entregable->cuantos}}</td>        
        <td>{{$entregable->descripcion}}</td>       
        <td>
          <button class="btn btn-danger btndel" value="{{$entregable->id}}">Eliminar</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entregablesModal">
    Agregar un entregable
  </button>
  </div>
<!-- Modal -->
<div class="modal fade large" id="entregablesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entregable</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar.">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmentregables" class="form-horizontal" novalidate="">
          @csrf   
          <div class="row">
            <div class="form-group col-md-12">
              <input id="noproyecto" type="hidden" value="{{$proyecto->id}}">
              <div class="form-group">
                <label for="descripcion">Seleccione de la lista o escriba lo que entregara:</label>
                <input class="form-control" id="descripcion" type="text" size="100" list="lstentregables" required>
                <datalist id="lstentregables">
                 @foreach($opciones as $opcion)
                   <option data-value="{{$opcion->tipo}}"> {{$opcion->descripcion}}</option>
                 @endforeach
                </datalist>
              </div>
              <div class="form-group">
                <label for="tipo">Seleccione el tipo de entregable:</label><br>
                 @foreach($tipos as $tipo)
                   <input type="radio" id="tipo_{{$tipo->tipo}}" name="tipo" value="{{$tipo->tipo}}">{{$tipo->tipo}}<br>
                 @endforeach
              </div>
              <div class="form-group">
                <label for="txtcuantos" size>Cuantos:</label>
                <input class="form-control" id="cuantos" type="number" step="1" min="1" max="3" value="0"  size="3" required>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnadd">+</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- 
        <button type="button" class="btn btn-primary">Agregar changes</button> -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('sctipts')
<script language="javascript">
  $(document).ready(function(){
    $("#btnadd").click(agregar);    
    $("#entregables-list tbody").on("click", ".btndel" , eliminar);
    $('#descripcion').on('input', marcar);
  });       
</script>
<script src="{{asset('js/entregables.js')}}"></script>

 @endsection

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">ENTREGABLES DEL PROYECTO: {{$proyecto->titulo}}</li>
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

