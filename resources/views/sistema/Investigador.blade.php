<!-- 

    Información básica del proyecto

Convocatoria:   Convocatoria 2018: Apoyo a la Investigación Científica y Tecnológica en los Programas Educativos de los Institutos Tecnológicos Federales y Centros
Responsable:    GUZMAN-SANCHEZ, JORGE OCTAVIO
Modalidad:  Por licenciatura
Sometido:   2018-01-24 12:03:31
Dictamen:   Aprobado con financiamiento el 2018-03-12 10:39:18  [Ver detalle]

////Información básica del proyecto
id, titulo, nombre_ies, nombre_pe, area, nivel_academico, 
actreditado_habilitado, pnpc, linea, fecha_elaboracion, 
fecha_inicio, fecha_fin, duracion, convocatoria_id, responsable, 
tipo_investigacion, sometido, dictamen, 

////protocolo
resumen, introduccion, antecedentes, hipotesis, marco_teorico, 
metas, objetivo_general, objetivos_especificos, impacto_beneficio, 
metodologia, vinculacion, referencias, lugar, infraestrucutura

//// integrantes [colaboradores]
id, users_id, proyecto_id, participacion

////entregables
id, tipo, cuantos, descripcion, proyecto_id

////cronograma  (Programa de actividades)
id, actividad, fecha_inicio, fecha_fin, monto, proyecto_id, entregables_id

////insumos-materiales y servicios

////concentrado del presupuesto solicitado

////periodos para para ejercer el recurso

//mostrar = 0,1,2 = no,ver,todo

/*
  if($proyecto->responsable==Auth::user()->id){
    if(sometido) solo ver
    else todo
  if($colaborador->users_id==Auth::user()->id) 
    solo ver
  
*/

 -->
@extends('layouts.app')
@section('content')
<div class="container">

    @if (\Session::has('success'))
      <div class="alert alert-success" >
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    @if (\Session::has('error'))
    <div class="alert alert-danger ">
      <p>{{ \Session::get('error') }}</p>
    </div><br/>
    @endif

      <a href="/proyecto/create" class="btn btn-primary">Agregar Proyecto</a>
    <br />

    <table class="table" border="1">
    <thead>
      <tr>
        <th>Convocatoria</th>
        <th colspan="3">Proyecto</th>
      </tr>
    </thead>
    <tbody id="ttt">
      @foreach($convocatorias as $convocatoria)
      <tr class="info">
        <td colspan="4">{{$convocatoria['Nombre']}} ({{$convocatoria['Fecha_inicio']}} - {{$convocatoria['Fecha_fin']}})</td>               
      </tr>
          @foreach($convocatoria->proyectos as $proyecto)
             <!-- Titulo: {{$proyecto['titulo']}} -  Director: {{$proyecto->director->name}}   -->
            @if($proyecto->responsable==Auth::user()->id )
               <!-- Sometidomio"{{$proyecto->sometido}}"-->
              @if($proyecto->sometido == "")
              <tr>
                <td></td>
                <td>Titulo: {{$proyecto['titulo']}} <br> Director: {{$proyecto->director->name}}</td>
                <td colspan="1">
                  <div class="dropdown">
                    <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuButton_miosin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Protocolo y desarrollo <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_miosin">
                      <ol>
                        <li><a class="dropdown-item" href="{{action('Investigador\ProyectoController@show', $proyecto['id'])}}">Información básica</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\ProtocoloController@mostar', $proyecto['id'])}}">Protocolo</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\ColaboradoresController@index', $proyecto['id'])}}">Colaboradores</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\EntregablesController@index', $proyecto['id'])}}">Entregables</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\CronogramaController@index', $proyecto['id'])}}">Actividades</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\GastosController@index', $proyecto['id'])}}">Presupuesto</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\VinculacionController@mostrar', $proyecto['id'])}}">Vinculación</a></li>
                        <li><a class="dropdown-item" href="{{action('Investigador\AvalController@mostrar', $proyecto['id'])}}">Aval de académia</a></li>
                        @if($convocatoria->vigente())
                          <li class="bg-warning"><a class="dropdown-item" href="{{action('Investigador\SometerController@someter', $proyecto['id'])}}">Someter</a></li>
                        @endif
                      </ol>
                    </div>
                  </div>
<!--
                   <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Seguimiento<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="#">8. Documentos de Propuesta</a></li>
                      <li><a href="#">9. Productividad</a></li>
                      <li><a href="#">10. Informes Técnicos</a></li>
                    </ul>
                  </div>
 -->
               </td>
                  <td>
                    <form action="{{action('Investigador\ProyectoController@destroy', $proyecto['id'])}}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                  </form>
                </td>
              </tr>
              @else<!--  no sometido , sigue siendo mio-->
              <tr>
                <td></td>
                <td>{{$proyecto['titulo']}} <br> Director: {{$proyecto->director->name}}</td>
                <td colspan="2" > 
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton_mio_sometido" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Documentos<span class="caret"></span>
                    </button>
                    <div class="dropdown-menu">
                      <ol>
                        @if($proyecto['ci01'] != "")
                        <li><a class="drowpdown-item" href="{{action('DocumentosController@dci01', $proyecto['id'])}}">CI-01</a></li>
                        @else
                        <li><a class="drowpdown-item" href="{{action('DocumentosController@ci01', $proyecto['id'])}}">CI-01</a></li>
                        @endif
                        @if($proyecto['di02'] != "")
                        <li><a class="drowpdown-item" href="{{action('DocumentosController@dci02', $proyecto['id'])}}">CI-02</a></li>
                        @else
                        <li><a class="drowpdown-item" href="{{action('DocumentosController@ci02', $proyecto['id'])}}">CI-02</a></li>
                        @endif


                        @if($proyecto['vinculacion'] != "")
                        <li><a href="{{action('DocumentosController@vinculacion', $proyecto['id'])}}">Vinculacion</a></li>
                        @endif

                        @if($proyecto['aval'] != "")
                        <li><a href="{{action('DocumentosController@aval', $proyecto['id'])}}">Aval de academia</a></li>
                        @else
                        <li class="bg-danger text-white">Sin Aval de academia</li>
                        @endif
                      </ol>
                    </div>
                  </div>                  
                </td>
              </tr>
              @endif 
            @else <!-- entonces no es mio -->
                @foreach($proyecto->colaboradores as $colaborador)
                    @if($colaborador->users_id==Auth::user()->id)
                      <tr>
                        <td></td>
                        <td>{{$proyecto['titulo']}} <br> Director: {{$proyecto->director->name}}</td>
                        <td colspan="2" > 
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton_deotro_sometido" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Documentos<span class="caret"></span>
                            </button>
                            <div class="dropdown-menu">
                              <ol>
                                @if($proyecto['ci01'] != "")
                                <li><a class="drowpdown-item" href="{{action('DocumentosController@dci01', $proyecto['id'])}}">CI-01</a></li>
                                @else
                                <li><a class="drowpdown-item" href="{{action('DocumentosController@ci01', $proyecto['id'])}}">CI-01</a></li>
                                @endif
                                @if($proyecto['di02'] != "")
                                <li><a class="drowpdown-item" href="{{action('DocumentosController@dci02', $proyecto['id'])}}">CI-02</a></li>
                                @else
                                <li><a class="drowpdown-item" href="{{action('DocumentosController@ci02', $proyecto['id'])}}">CI-02</a></li>
                                @endif
                                @if($proyecto['vinculacion'] != "")
                                <li><a href="{{action('DocumentosController@vinculacion', $proyecto['id'])}}">Vinculacion</a></li>
                                @endif
                                @if($proyecto['aval'] != "")
                                <li><a href="{{action('DocumentosController@aval', $proyecto['id'])}}">Aval de academia</a></li>
                                @else
                                <li class="bg-danger text-white">Sin Aval de academia</li>
                                @endif
                              </ol>
                            </div>
                            @if($colaborador->participacion==0 && $proyecto->sometido == "" && $convocatoria->vigente() )
                              <button class="btn btn-success btnaceptar" value="{{$colaborador->id}}">Aceptar</button>
                              <button class="btn btn-danger btnrechaza" value="{{$colaborador->id}}">Rechazar</button>
                            @endif
                          </div>
                        </td>
                      </tr>
                    @endif
                @endforeach                    
                </td>
              </tr>
            @endif
          @endforeach
     @endforeach
    </tbody>
  </table>
   {{ $convocatorias->links() }}
  </div>
@endsection

@section('sctipts')
<script language="javascript">
  $( document ).ready(function() {
    $(".btnaceptar").click(aceptar);    
    $(".btnrechaza").click(rechaza);    
  });
</script>
 <script src="{{asset('js/aceptacion.js')}}"></script>
 @endsection