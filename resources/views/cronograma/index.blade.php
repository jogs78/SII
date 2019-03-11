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
        <th>PERIODO</th>
        <!-- <th>MONTO</th> -->
        <th>ENTREGABLE</th>
        <th>ELIMINAR</th>
      </tr>
    </thead>
    <tbody> 
    <!-- {{$num=1}} -->     
      @foreach($actividades as $actividad)
      <tr id="actividad_{{$actividad->id}}" >
        <!-- <td>{{$num++}}</td> -->
        <td>{{$actividad->actividad}}</td>
        <td>{{$actividad->fecha_inicio}} a {{$actividad->fecha_fin}}</td>        
<!--        <td>{{$actividad->monto}}</td> -->
        <td>{{$actividad->entregable->descripcion}}</td>       
        <td>
          <button class="btn btn-danger btndel" value="{{$actividad->id}}">Eliminar</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#activiadesModal">
    Agregar una actividad
  </button>
  </div>
<!-- Modal -->
<div class="modal fade large" id="activiadesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actividades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar.">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
    <!--   id, actividad, fecha_inicio, fecha_fin, monto, proyecto_id, entregables_id  -->


      <div class="modal-body">
        <form class="form-horizontal" id="frmactiviades"> 
          <input id="proyecto_id" type="hidden" value="{{$proyecto->id}}">
          <div class="row">
            <div class="form-group col-3">
                <label for="descripcion">Actividad:</label>
                <textarea class="form-control" id="actividad" rows="6" cols="30"></textarea>
            </div>
            <div class="form-group col-9">
            <div class="row">   
              <div class="form-group col-6">
                <label for="fecha_inicio">Fecha inicial:</label>
                <input  class="form-control"  id="fecha_inicio" type="date" required >
              </div>
              <div class="form-group col-6">
                <label for="fecha_fin">Fecha final:</label>
                <input  class="form-control"  id="fecha_fin" type="date" required >
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12">
                <label for="entregable">Entregable:</label>
                <select class="form-control" id="entregables_id">
                  <option value="" selected>Sin entregable</option>
                  @foreach($opciones as $opcion)
                  <option value="{{$opcion->id}}">{{$opcion->descripcion}}:{{$opcion->cuantos}}</option>
                  @endforeach
                  </select>
              </div>
            </div>
          </div> <!-- row -->
        </form>
      </div> <!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnadd">Agregar Actividad</button>
      </div> <!-- modal-footer -->
    </div> <!-- modal-content -->
  </div> <!-- modal-dialog -->
</div> <!-- modal fade -->
@endsection

@section('sctipts')
    <script src="{{asset('js/cronograma.js')}}"></script>
    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
<script language="javascript">
  $(document).ready(function(){
    $("#btnadd").click(agregar);    
    $("#actividades-list tbody").on("click", ".btndel" , eliminar);
    
    $('#actividades-list').dataTable(
      {
        "paginate": false,
        "info": false,
        "searching": false,       
      }
    );
  });       
</script>

 @endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">CRONOGRAMA DE ACTIVIADES DEL PROYECTO: {{$proyecto->titulo}}</li>
@endsection


@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
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