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
    <table id="colaboradores-list" class="table table-striped">
    <thead>
      <tr>
        <th>CVU</th>
        <th>NOMBRE</th>
        <th>ACEPTACION</th>
        <th>ELIMINAR</th>
      </tr>
    </thead>
    <tbody>      
      @foreach($colaboradores as $colaborador)
      <tr id="colaborador_{{$colaborador->id}}">
        <td>{{$colaborador->cvutecnm}}</td>
        <td>{{$colaborador->name}}</td>        
        <td>
          @if ( $colaborador->participacion == null)
            Aún no acepta
          @else
            Acepto
          @endif
        </td>        
        <td>
          <button class="btn btn-danger btndel" value="{{$colaborador->id}}">Eliminar</button>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#colaboradoresModal">
    Agregar un colaborador
  </button>
  </div>
<!-- Modal -->
<div class="modal fade" id="colaboradoresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Investigadores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar.">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmcolaboradores" class="form-horizontal" novalidate="">

                  @csrf

          <div class="row">
            <div class="form-group col-md-12">
              <input id="noproyecto" type="hidden" value="{{$proyecto->id}}">
              <label for="director">Agregar colaborador:</label>
                <select id="investigador">
                 @foreach($investigadores as $investigador)
                   <option value="{{$investigador->id}}"> {{ $investigador->name }} </option>
                 @endforeach
                </select>
                <button type="button" class="btn btn-primary" id="btnadd">+</button>
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
  $( document ).ready(function() {
    $("#btnadd").click(agregar);    
    $("#colaboradores-list tbody").on("click", ".btndel" , desinvitar);
  });
</script>
 <script src="{{asset('js/colaboradores.js')}}"></script>
 @endsection

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">COLABORADORES DEL PROYECTO: {{$proyecto->titulo}}</li>
@endsection

