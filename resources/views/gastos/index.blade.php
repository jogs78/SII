<!-- index.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
    @if(\Session::has('success'))
      <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
      </div><br/>
     @endif
    <table id="actividades-list" border="1" class="table table-striped">
    <thead>
      <tr>
        <!-- <th>#</th> -->
        <th>ACTIVIDAD</th>
        <th>GASTOS</th>
        <!--<th>MONTO</th>
        <th>ENTREGABLE</th> -->
      </tr>
    </thead>
    <tbody> 
    <!-- {{$num=1}} -->     
      @foreach($actividades as $actividad)
      <tr id="actividad_{{$actividad->id}}" >
        <!-- <td>{{$num++}}</td> -->
        <td>{{$actividad->actividad}}</td>
        <td>
          <table class="gastos-list" id="gastos-list_actividad_{{$actividad->id}}" border="1" class="table table-striped">
            <thead>
              <tr>
                <th>PATIDA</th>
                <th>DESCIPCION</th>
                <th>MONTO</th>
                <th>ELIMINAR</th>
              </tr>
            </thead>
            <tbody> 
              @foreach($actividad->gastos as $gasto)
              <tr id="gasto_{{$gasto->id}}"> 
                <td>{{$gasto->partida}}</td>
                <td>{{$gasto->descripcion}}</td>
                <td>{{$gasto->monto}}</td>
                <td><button class="btn btn-danger btndel" value="{{$gasto->id}}">Eliminar</button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <button type="button" class="btn btn-primary btnadd2" id="{{$actividad->id}}">Agregar gasto a la activiad</button>
        </td>    
      @endforeach
    </tbody>
  </table>
  <!-- Button trigger modal
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gastosModal">
    Agregar gasto
  </button> -->
  </div>

<!-- Modal  QUITE LA CASE fade AL #gastosModal  -->
<div class="modal large " id="gastosModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gastos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar.">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form-horizontal" id="frmactiviades"> 
          <input id="proyecto_id" type="hidden" value="{{$proyecto->id}}">
          <input id="cronograma_id" type="hidden" value="">
            <div class="row">   
              <div class="form-group col-12">
                <select id="partida">
                  @foreach($opciones as $opcion)
                  <option value="{{$opcion->partida}}">{{$opcion->partida}}: {{$opcion->descripcion}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">   
              <div class="form-group col-12">
                <label for="descripcion">Descripcion:</label>
                <input  class="form-control"  id="descripcion" type="text" required >
              </div>
          </div> <!-- row -->
            <div class="row">   
              <div class="form-group col-12">
                <label for="monto">Monto:</label>
                <input  class="form-control"  id="monto" type="numeric" required >
              </div>
          </div> <!-- row -->
        </form>
      </div> <!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnadd">Agregar Gasto</button>
      </div> <!-- modal-footer -->
    </div> <!-- modal-content -->
  </div> <!-- modal-dialog -->
</div> <!-- modal fade -->
@endsection

@section('sctipts')
    <script src="{{asset('js/gastos.js')}}"></script>
<script language="javascript">
  $(document).ready(function(){
    $(".btnadd2").click(function (){
//      alert("hola");
        $('#cronograma_id').val( this.id  );
        $('#gastosModal').modal();
    });    
    $("#btnadd").click(agregar);    
    $("#actividades-list .gastos-list tbody").on("click", ".btndel" , eliminar);
    
  });       
</script>

 @endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">CRONOGRAMA DE ACTIVIADES DEL PROYECTO: {{$proyecto->titulo}}</li>
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



