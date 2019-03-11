<!-- show.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
    @if(\Session::has('success'))
      <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
      </div><br/>
    @endif
<!--
0.- Convocatoria
1. Protocolo
2. Colaboradores
3. Entregables
4. Cronograma
5. Presupuesto (financiado)
-->

  <div id="accordion0">
    @foreach($validacion as $rubro)
      <div class="card">
        <div class='card-header {{$rubro["resultado"]}}' id="heading{{$loop->index}}">
          
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="true" aria-controls="collapse{{$loop->index}}">
              {{$rubro["categoria"]}}
            </button>
          
        </div>
        <div id="collapse{{$loop->index}}" class='collapse {{$rubro["resultado"]}}' aria-labelledby="heading{{$loop->index}}" data-parent="#accordion0">
          <div class="card-body">
            {!!$rubro["mensaje"]!!}
           </div>
        </div>
      </div>
    @endforeach
  </div>

 @if($puede==true)
    Descarga los archivos (CI-01 y CI-02), consigue las firmas, digitalizalos y subelos al sistema en formato pdf.
    <ul>
      <li><a href="{{action('DocumentosController@ci01', $proyecto['id'])}}">CI-01</a></li>
      <li><a href="{{action('DocumentosController@ci02', $proyecto['id'])}}">CI-02</a></li>
    </ul>

            <div class="card">
                <div class="card-header">Someter</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            Revisa:<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    <form method="post" action="{{action('Investigador\SometerController@update', $proyecto->id)}}" enctype="multipart/form-data" >  
      {{ csrf_field() }}
      <input type="hidden" name="fgh" id="asd" value = "otro">
      <div class="row">
        <div class="form-group col-12">
            <lable>CI-01 firmado:</label>
            <input  class="form-control" id="ci_01" name="ci_01" type="file"  accept=".pdf" required >
            <small id="fileHelp" class="form-text text-muted">Por favor use un archivo con formato pdf, no debe ser mayor a  2MB.</small>
        </div>
      </div> <!-- row -->
      <div class="row">
        <div class="form-group col-12">
            <lable>CI-02 firmado:</label>
            <input  class="form-control" id="ci_02" name="ci_02" type="file"  accept=".pdf" required >
            <small id="fileHelp" class="form-text text-muted">Por favor use un archivo con formato pdf, no debe ser mayor a  2MB.</small>
        </div>
      </div> <!-- row -->
        <button type="submit" class="btn btn-success" value="Submit">Someter</button>
    </form>
    </div>
</div>
</div>
</div>

  @endif



@endsection

@section('sctipts')
<script src="{{asset('js/vinculacion.js')}}"></script>
<script language="javascript">
  $(document).ready(function(){
/* 
   $("#frmvinculacion").on("click", ".btndel" , function (e){
      e.preventDefault(); 
      eliminar( this.value );
    });
    $('#archivo').on('change', agregar);

*/
  });       
</script>
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">SOMETER EL PROYECTO: {{$proyecto->titulo}}</li>
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

