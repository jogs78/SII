<!-- mostrar.blade.php -->
@extends('layouts.app')
@section("content")
<div class="container">
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
  </div>
@endif
@if (\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
  </div>
 @endif
  <form method="post" action="{{action('Investigador\ProtocoloController@update', $proyecto->id)}}">  
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          @foreach($partes as $parte)
            <a class="nav-link @if($loop->first) active show @endif "  data-toggle="pill" href="#t{{$parte->campo}}" role="tab" aria-controls="{{$parte->campo}}" aria-selected="true">{{$parte->descripcion}}</a>
          @endforeach
        </div>
      </div> <!-- .col-md-2 -->
      <div class="col-md-10">
        <div class="tab-content" id="v-pills-tabContent">
          @foreach($partes as $parte)

            <div class="tab-pane fade @if($loop->first) active show @endif" id="t{{$parte->campo}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <textarea class="form-control" name="{{$parte->campo}}" id="{{$parte->campo}}" rows="20" cols="30" maxlength="{{$parte->valor}}">{{ $protocolo["$parte->campo"] }}</textarea>
              <div class="alert alert-info col-4" id="l{{$parte->campo}}" role="alert"></div>
            </div>
          @endforeach
        </div>
      </div> <!-- .col-md-10 -->
    </div>
    <div class="row">
      <button type="submit" class="btn btn-success" value="Submit">Guardar</button>
    </div>
  </form>
@endsection

@section('sctipts')
<script language="javascript">
  $( document ).ready(function() {
    $('textarea').keyup(function (e) {
        var este = $(this),
            maxlength = este.attr('maxlength'),
            maxlengthint = parseInt(maxlength),
            textoActual = este.val(),
            currentCharacters = este.val().length;
            remainingCharacters = maxlengthint - currentCharacters,
            espan = este.next();            
            // Detectamos si es IE9 y si hemos llegado al final, convertir el -1 en 0 - bug ie9 porq. no coge directamente el atributo 'maxlength' de HTML5
            if (document.addEventListener && !window.requestAnimationFrame) {
                if (remainingCharacters <= -1) {
                    remainingCharacters = 0;            
                }
            }
            var porcentaje = currentCharacters * 100 / maxlengthint;
            espan.html(currentCharacters + "/" + maxlengthint + ", quedan " + remainingCharacters + " caracteres (" + porcentaje + "%)" );
            if (!!maxlength) {
                espan.removeClass();
                if ( porcentaje > 80 && porcentaje <= 90){
                  //amarillo
                  espan.addClass("alert alert-warning col-4");
                }else if ( porcentaje > 90){
                  //rojo
                  espan.addClass("alert alert-danger col-4");
                }else{
                  //verde
                  espan.addClass("alert alert-success col-4");
                }
            }   
        });
      $("textarea").keyup();
//    var $divs = $('div');
//    $("#btnadd").click(agregar);    
//    $("#colaboradores-list tbody").on("click", ".btndel" , desinvitar);
  });

</script>

 @endsection


@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">PROTOCOLO DEL PROYECTO: {{$proyecto->titulo}}</li>
@endsection

