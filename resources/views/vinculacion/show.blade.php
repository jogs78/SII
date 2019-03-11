<!-- show.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
    <form class="form-horizontal" enctype="multipart/form-data" id="frmvinculacion"> 
      <input id="proyecto_id" type="hidden" value="{{$proyecto->id}}">
      <div class="row">
        <div class="form-group col-9">
            <input  class="form-control" id="archivo" type="file"  accept=".pdf" @if($proyecto->tvinculacion!= "" ) required @endif >
        </div>
        <div class="form-group col-3">
            <button class="btn btn-danger btndel" value="{{$proyecto->id}}">Eliminar</button>
        </div>
      </div> <!-- row -->
    </form>

      <embed id="pdf" type="application/pdf" src="
      @if ($vinculacion->vinculacion === null){{asset('evidencias/blanco.pdf' )}}
      @else{{asset('evidencias/'. $vinculacion->vinculacion)}}@endif
      " width="100%" height="1100px">
  </div> 
@endsection

@section('sctipts')
    <script src="{{asset('js/vinculacion.js')}}"></script>

<script language="javascript">
  $(document).ready(function(){
    $("#frmvinculacion").on("click", ".btndel" , function (e){
      e.preventDefault(); 
      eliminar( this.value );
    });
    $('#archivo').on('change', agregar);
  });       
</script>

 @endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">VINCULACION DEL PROYECTO: {{$proyecto->titulo}}</li>
@endsection


@section('styles')
<style>
.pdfobject-container { height: 500px;}
.pdfobject { border: 1px solid #666; }

input:invalid{
  border-color:red;
  border-width: 10px;
}
input:valid{
 border-color:blue; 
}
</style>
@endsection
