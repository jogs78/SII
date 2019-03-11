<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
          html {
        margin: 0;
      }
      body {
      font-family: "Times New Roman", serif;
      margin: 15mm 8mm 2mm 8mm;
      }
    header { position: fixed; top: 5mm; left: 5mm;}
    footer { position: fixed; bottom: 05mm; left: 0mm;}


      footer .pagenum:before {
        content: counter(page);
      }
      h3{
        text-align: center;
        font-weight: bold;
      }
      p{
        text-align: justify;
      }
      table,td,th{
        table-layout: fixed;
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
      }
      thead,tfoot{
        background-color: gray;
        text-align: center;
      }
      tbody {
        padding: 5px;
        text-align: left;
      }
      .caja { float:left;
        margin-left:5px;
        border-top: 1px solid;
        border-right: 1px solid ;
        border-bottom: 1px solid ;
        border-left: 1px solid ;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <header>M00-PR-03-R01</header>
    <footer>
        <span><?php echo date('d/m/Y h:i:s a');?></span>
        <div style="float: right ; text-align: right" class="pagenum-container">Pagina: <span class="pagenum"></span></div>
    </footer>

    <h3>FORMATO CONCENTRADOR DE SOLCITUD DE APOYO ECONÓMICO</h3>
    <h3>(CI-01/{{$proyecto->fecha_inicio}})</h3>
    <table>
      <tr>
        <th colspan="2"><b>NOMBRE DE LA INSTITUTCION: </b> {{$proyecto->nombre_ies}}</th>
      </tr>
      <tr>
        <td>
          Responsable del Proyecto:
          <br>
          <b>{{$proyecto->director->name}}</b>
          <br>
          CVU-TecNM:
          <br>
          <b>{{$proyecto->director->cvutecnm}}</b>
        </td>
        <td>
          Titulo del proyecto:
          <br>
          <b>{{$proyecto->titulo}}</b>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          Tipo de investigación: <b>{{$proyecto->tipo_investigacion}}</b>
          <br>
          Area del conocimiento: <b>{{$proyecto->area}}</b>
          <br>
          Ejercicio del proyecto: <b>{{ $proyecto->ejercicio()}} </b>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          Programa eductativo: <b>{{$proyecto->programa_educativo->programa}}</b>
          <br>
          Nivel: <b>{{$proyecto->programa_educativo->nivel}}</b>
          <br>
          Linea de investigacion: <b>{{$proyecto->linea}}</b>
        </td>
      </tr>
    </table>
    <br>
<table>
  <thead>
    <tr>
      <th colspan="4">INTEGRANTES DEL PROYECTO</th>
    </tr>
    <tr>
      <td>CVU-TecNM</td>
      <td>Integrante</td>
      <td>Rol</td>
      <td>Fimra autógrafa</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$proyecto->director->cvutecnm}}</td>
      <td><b>{{$proyecto->director->name}}</b>
        <br>
        Adscripción: {{$proyecto->director->adscripcion}}
      </td>
      <td style="text-align: center">Responsable</td>
      <td></td>
    </tr>
      @foreach($proyecto->colaboradores as $colaborador)
        <tr>
              <td>{{$colaborador->quien->cvutecnm}}</td>
              <td>{{$colaborador->quien->name}}
              <br>
              Adscripción: {{$colaborador->quien->adscripcion}}
              </td>
              <td style="text-align: center">Colaborador</td>
              <td></td>
        </tr>
    @endforeach
  </tbody>
</table>
<br>

<table style="">
  <thead>
    <tr>
        <th><b>OBJETIVO DEL PROYECTO</b></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1. GENERAL
        <br>
        {{$proyecto->objetivo_general }}
      </td>
    </tr>
     <tr>
      <td>2. ESPECIFICO
        <br>
          {{$proyecto->objetivos_especificos}}
      </td>
    </tr>
  </tbody>
</table>
<br>


@php
  $entregablesa = $proyecto->entregables->where('tipo',"ACADEMICO");
  $listaa = "<ol>";
  foreach ($entregablesa as $entregable) {
    $listaa .= "<li>$entregable->descripcion: $entregable->cuantos</li>";
  }
  $listaa . "</ol>";

  $entregablesh = $proyecto->entregables->where('tipo',"HUMANO");
  $listah = "<ol>";
  foreach ($entregablesh as $entregable) {
    $listah .= "<li>$entregable->descripcion: $entregable->cuantos</li>";
  }
  $listah . "</ol>";
@endphp


<table>
  <thead>
    <tr>
      <th colspan="2">PRODUCTOS ENTREGABLES</th>
    </tr>
    <tr>
      <th>Cotribucion a la Formacion de Recursos Humanos</th>
      <th>Productividad Académica</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{!!$listah!!}</td>
      <td>{!!$listaa!!}</td>
    </tr>
  </tbody>
</table>
<h3>Cronograma de Actividades</h3>
<table>
  <thead>
    <tr>
      <th>No.</th>
      <th>Actividad</th>
      <th>Entregables</th>
      <th>Periodo de realizacion</th>
      <th>Monto</th>
    </tr>
  </thead>
  <tbody>
    @php
      $actividades = $proyecto->actividades;
    @endphp
    @foreach ($actividades as $actividad)
      <tr>
         <td>{{$loop->iteration}}</td>
        <td>{{$actividad['actividad']}}</td>
        <td>{{$actividad->entregable->descripcion}}</td>
         <td>{{$actividad->fecha_inicio}} a {{$actividad->fecha_fin}}</td>
         @php
            $suma = 0;
            $gastos=$actividad->gastos;
            foreach ($gastos as $gasto) {
              $suma += $gasto->monto;
            }
         @endphp
        <td style="text-align: right">
          $ {{$suma}}
        </td>
     </tr>
    @endforeach
  </tbody>
</table>


<h3>Materiales y Servicios</h3>
<table>
  <thead>
    <tr>
      <th>Material o Servicio</th>
      <th>Periodos</th>
      <th>Monto solicitado</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($proyecto->gastos as $gasto)
      <tr>
         <td>
          Partida: {{$gasto->partida}}<br>
          Descripción: {{$gasto->descripcion}}<br>
         </td>
         <td>{{$gasto->actividad->fecha_inicio}} al {{$gasto->actividad->fecha_fin}}</td>
         <td style="text-align: right">$ {{$gasto->monto}}</td>
     </tr>
    @endforeach
  </tbody>
</table>

<h3>Concentrado del Presupuesto</h3>
<table>
  <thead>
    <tr>
      <th>Concepto</th>
      <th>Monto</th>
    </tr>
  </thead>
  <tbody>
    @php
      $s2000 = $proyecto->gastos->where('partida', '>=' , 20000)->where('partida', '<=' , 29999);
            $suma2=0;
            foreach ($s2000 as $gasto) {
              $suma2 += $gasto->monto;
            }

      $s3000 = $proyecto->gastos->where('partida', '>=' , 30000)->where('partida', '<=' , 39999);
            $suma3=0;
            foreach ($s3000 as $gasto) {
              $suma3 += $gasto->monto;
            }
    @endphp
      <tr>
         <td>Capitulo 2000</td>
        <td style="text-align: right">${{$suma2}}</td>
      </tr>
      <tr>
         <td>Capitulo 3000</td>
        <td style="text-align: right">${{$suma3}}</td>
     </tr>
  </tbody>
  <tfoot>
    <tr>
      <td>Suma</td>
      <td style="text-align: right">${{$suma2 + $suma3}}</td>
    </tr>
  </tfoot>
</table>

<!--
<h3>periodos para ejercer el recurso</h3>
<table>
  <thead>
    <tr>
      <th>No.</th>
      <th>Actividad</th>
      <th>Entregables</th>
      <th>Periodo de realizacion</th>
      <th>Monto</th>
    </tr>
  </thead>
  <tbody>
    @php
      $actividades = $proyecto->actividades;
    @endphp
    @foreach ($actividades as $actividad)
      <tr>
         <td>{{$loop->iteration}}</td>
        <td>{{$actividad['actividad']}}</td>
        <td>{{$actividad->entregable->descripcion}}</td>
         <td>{{$actividad->fecha_inicio}} a {{$actividad->fecha_fin}}</td>
         @php
            $suma = 0;
            $gastos=$actividad->gastos;
            foreach ($gastos as $gasto) {
              $suma += $gasto->monto;
            }
         @endphp
        <td>
          $ {{$suma}}
        </td>
     </tr>
    @endforeach
  </tbody>
</table>
 -->
<br>
<br>
<br>
  <div style="position:relative; left:2%;">
    <div class="caja" style=" width:45%;">
            Profesor Investigador Responsable:
      <br>
      <br>
      <br>
      <br>
      Nombre y firma
    </div>
  <div class="caja" style=" width:45%;">

    Diector del plantel

    <br>
    <br>
    <br>
    <br>

    Nombre y firma

</div>

</div>
  </body>

</html>
