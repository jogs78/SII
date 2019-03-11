@extends('layouts.app')
@section('content')
  <div class="container" id="dashboard">
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
    <p>{{ \Session::get('success') }}</p>
    </div><br/>
    @endif
    @if (\Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
    <p>{{ \Session::get('error') }}</p>
    </div><br/>
    @endif

    <div class="row justify-content-left">  {{-- primer fila --}}
      <div class="col-2 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
            <a  style="padding: 0;" href="registrados">
              <img src="logos/item.png" alt="">
            </a>
          </div>
          <div class="col-6"  style="border: 0px;">
            <a href="/proyecto/especial">
              <img src="logos/mas.png" alt="" >
            </a>
          </div>
        </div>
        <div class="row">
          Proyectos registrados:{{$proyecto}}
        </div>
      </div>

      <div class="col-2 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
          <a style="display:inline;" href="convocatoria">
            <img src="logos/item.png"   usemap="#map" alt="">
          </a>
          </div>
          <div class="col-6" style="border: 0px;">
          <a href="/convocatoria/create">
            <img src="logos/mas.png" usemap="#create" alt="" >
          </a>
          </div>
        </div>
        <div class="row">
          Convocatorias:  {{$convocatorias}}
        </div>
      </div>
      <div class="col-2 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
            <a href="crudgastos">
              <img src="logos/item.png" alt="">
            </a>
          </div>
          <div class="col-6" style="border: 0px;">
            <a href="/crudgastos/create">
              <img src="logos/mas.png" alt="" >
            </a>
          </div>
        </div>
        <div class="row">
          Catalogo de gastos: {{$gastos}}
        </div>
      </div>
      <div class="col-2 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
            <a href="crudlineas">
                <img src="logos/item.png" alt="">
            </a>
          </div>
          <div class="col-6" style="border: 0px;">
            <a href="/crudlineas/create" shape="poly" coords="13,11,499,14,498,498,14,500" />
              <img src="logos/mas.png" alt="" >
            </a>
          </div>
        </div>
        <div class="row">
          Lineas de investigacion:{{$lineas}}
        </div>
      </div>
      <div class="col-2 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
            <a href="crudusers">
              <img src="logos/item.png" alt="">
            </a>
            </div>
          <div class="col-6" style="border: 0px;">
            <a title="" href="/crudusers/create">
              <img src="logos/mas.png" alt="" >
            </a>
          </div>
        </div>
        <div class="row">
          Usuarios registrados: {{$count}}
        </div>
      </div>
    </div> {{-- primer fila --}}

    <div class="row justify-content-left"> {{-- segunda fila --}}
      <div class="col-3 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
            <a href="crudadscripcion" style="displa:inline">
              <img src="logos/item.png" alt="">
            </a>
          </div>
          <div class="col-3" style="border: 0px;">
            <a href="/crudadscripcion/create">
              <img src="logos/mas.png" alt="" style="width:70px;">
            </a>
          </div>
        </div>
        <div class="row">
          Adscripción{{--$longitud--}}
        </div>
      </div>
      <div class="col-3 bg-primary text-white">
        <div class="row">
          <div class="col-6" style="border: 0px;">
            <a href="crudlongitudecaracteres">
              <img src="logos/item.png" alt="">
            </a>
          </div>
        </div>
        <div class="row">
          Partes y longitudes del protocolo
        </div>
      </div>
      <div class="col-3 bg-primary text-white">
        <div class="row">
          <a href="rregistro">
            <img src="logos/item.png" alt="">
          </a>
        </div>
        <div class="row">
          Restricciones de registro
        </div>
      </div>
      <div class="col-3 bg-primary text-white">
        <div class="row">

          <div class="col-6" style="border: 0px;">
            <a href="crudpe" style="displa:inline">
              <img src="logos/item.png" alt="">
            </a>
          </div>
          <div class="col-3" style="border: 0px;">
            <a href="/crudpe/create">
              <img src="logos/mas.png" alt="" style="width:70px;">
            </a>
          </div>


        </div>

        <div class="row">
        Programa Educativo
        </div>
      </div>
    </div> {{-- segunda fila --}}
    <!--
          <div class="col-6" style="border: 0px;">
          </div>
          <div class="col-6" style="border: 0px;">
          </div>
     -->

    <div class="row justify-content-left"> {{-- tercer fila --}}
      <div class="col-4 bg-primary text-white">
        <div class="row">
          <a href="crudentregables">
            <img src="logos/item.png" alt="">
          </a>
          <a href="crudentregables/create">
            <img src="logos/mas.png" alt="" style="width:70px;">
          </a>
        </div>
        <div class="row">
        Entregables:{{$entregable}}
        </div>
      </div>
      <div class="col-4 bg-primary text-white">
        <div class="row">
          <a href="crudareas"><img src="logos/item.png" alt=""></a>
          <a href="crudareas/create"><img src="logos/mas.png" alt="" style="width:70px;"></a>
        </div>
        <div class="row">
          Areas registradas:{{$catalogo}}
        </div>
      </div>

      <div class="col-4 bg-primary text-white">
        <div class="row">
          <a href="crudinvestigacion">
            <img src="logos/item.png" alt="">
          </a>
          <a href="crudinvestigacion/create">
            <img src="logos/mas.png" alt="" style="width:70px;">
          </a>
        </div>
        <div class="row">
          Tipos de investigacion:{{$tipo}}
        </div>
      </div>
    </div>{{-- tercer fila --}}
@endsection
@section('styles')
<style>
div[class^='col-']{
  border: 1px solid white;
}
a img{
  width: 100%;
}
.row a{
  display: inline;
}

</style>
@endsection
