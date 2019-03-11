<?php

namespace App\Http\Controllers\Investigador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;


use App\Models\Proyecto;
use App\Models\Someter;
use App\Models\Convocatoria;
use App\Models\Colaboradores;
use App\Models\Entregables;
use App\Models\Cronograma;

use App\Models\User;

use App\Models\Vinculacion;

use App\Models\RestriccionesR;

//use App\Models\User;

class SometerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Investigador');
    }


    public function someter($idproy)
    {
/*
        $validacion = array(
            'convocatoria' => array('rubro' => "rubro" ,'resultado' => "resultado", 'mensaje' => "mensaje", ) ,
            'rubro' => array('rubro' => "rubro" ,'resultado' => "resultado", 'mensaje' => "mensaje", ) ,

            );


La restriccion:
5.- Máximo de colaboradores en un proyecto 
es igual a 
7.- Máximo de colaboradores por proyecto               
*/

        $puede = true;

        $proyecto= Proyecto::find($idproy);

//0.Convocatoria en tiempo
        $convocatoria = $proyecto->Convocatoria;
        $ConvocatoriaFechaInicio = new \DateTime($convocatoria->Fecha_inicio);
        $ConvocatoriaFechaFin  = new \DateTime($convocatoria->Fecha_fin);
        $fechaSometido = new \DateTime(); // Today
        $fechaSometido->format('d/m/Y'); // echos today!

        $validacion["convocatoria"]["categoria"] = "Convocatoria";
        if(
          $fechaSometido->getTimestamp() >= $ConvocatoriaFechaInicio->getTimestamp() &&
          $fechaSometido->getTimestamp() <= $ConvocatoriaFechaFin->getTimestamp() ) {
            $validacion["convocatoria"]["resultado"] = "alert-success";
            $validacion["convocatoria"]["mensaje"] = "En tiempo (sometido antes de $convocatoria->Fecha_fin)";
        }else{
            $validacion["convocatoria"]["resultado"] = "alert-danger";
            $validacion["convocatoria"]["mensaje"] = "Sometido fuera del tiempo de la convocatoria";
            $puede = false;
        }

//1. Protocolo
/*
////protocolo
resumen, introduccion, antecedentes, hipotesis, marco_teorico,
metas, objetivo_general, objetivos_especificos, impacto_beneficio,
metodologia, referencias, lugar, infraestrucutura
*/
//2. Colaboradores
    $Colaboradores = $proyecto->Colaboradores;
    $validacion["Colaboradores"]["categoria"] = "Colaboradores:";
    $todos=true;
    $acep="<ul>";
    $cuantos=0;
    foreach($Colaboradores as $colaborador){
        $quien = $colaborador->quien;
        $cuantos++;
        if ( $colaborador->participacion == null){
            $acep .= "<li>$quien->name aún no acepta</li>";
            $todos=false;
        }else{
            $acep .= "<li>$quien->name ya acepto</li>";
        }
    }
    $acep .= "</ul>";

    if($todos) {
            //////RESTRICCION DE MAXIMO Y MINIMO DE COLABORADORES
            $Maximo = RestriccionesR::find(7);
            $Minimo = RestriccionesR::find(8);

            if($cuantos <  $Minimo->valor ) {
                $validacion["Colaboradores"]["resultado"] = "alert-danger";
                $validacion["Colaboradores"]["mensaje"] = "Este proyecto no cuenta con los colaboradores suficientes";
                $puede = false;
            }elseif($cuantos >  $Maximo->valor ) {
                $validacion["Colaboradores"]["resultado"] = "alert-danger";
                $validacion["Colaboradores"]["mensaje"] = "Este proyecto exede en numero de colaboradores";
                $puede = false;
            }else{
                $validacion["Colaboradores"]["resultado"] = "alert-success";
                $validacion["Colaboradores"]["mensaje"] = $acep;
            }
    }else{
        $validacion["Colaboradores"]["resultado"] = "alert-danger";
        $validacion["Colaboradores"]["mensaje"] = $acep;
        $puede = false;
    }




//3. Entregables
    $Entregables = $proyecto->entregables;
    $validacion["Entregables"]["categoria"] = "Entregables:";
    $validacion["Entregables"]["resultado"] = "alert-waning ";
    $validacion["Entregables"]["mensaje"] = "nada";
    $cuantos=0;
    $acep="<table border='1'><thead><th>TIPO</th><th>CUANTOS</th><th>DESCRIPCION</th></thead><tbody>";
    foreach($Entregables as $entregable){
        $acep .= "<tr><td>$entregable->tipo</td><td>$entregable->cuantos</td><td>$entregable->descripcion</td><tr>";
        $cuantos++;
    }
    $acep .= "</tbody></table>";
    if($cuantos!=0) {
        $validacion["Entregables"]["resultado"] = "alert-success";
        $validacion["Entregables"]["mensaje"] = $acep;
    }else{
        $validacion["Entregables"]["resultado"] = "alert-danger";
        $validacion["Entregables"]["mensaje"] = "Este proyecto no tiene entregables";
        $puede = false;
    }
//4. Cronograma

    $Actividades = $proyecto->actividades;
    $validacion["Actividades"]["categoria"] = "Actividades:";
    $cuantos=0;
    $acep="<table border='1'><thead><th>ACTIVIDAD</th><th>FECHAS</th><th>DESCRIPCION</th></thead><tbody>";
    foreach($Actividades as $actividad){
        $entregable = $actividad->entregable;
        $acep .= "<tr><td>$actividad->actividad</td><td>$actividad->fecha_inicio a $actividad->fecha_fin</td><td>$entregable->descripcion</td><tr>";
        $cuantos++;
    }
    $acep .= "</tbody></table>";




    $entregables_sin_activiad = 0;
    $entregables_sin_activiad = DB::table('entregables')
                ->where('proyecto_id', '=' , $idproy )
                ->whereRaw('id not in (SELECT DISTINCT IFNULL(entregables_id,0) FROM cronograma where proyecto_id = ?)', [$idproy])
                ->count();

    if($cuantos!=0) {
        $validacion["Actividades"]["resultado"] = "alert-success";
        $validacion["Actividades"]["mensaje"] = $acep;
        if($entregables_sin_activiad>0) {
            $validacion["Actividades"]["resultado"] = "alert-danger";
            $validacion["Actividades"]["mensaje"] = "Este proyecto tiene $entregables_sin_activiad entregables sin que se les asigne actividades";
            $puede = false;
            
        }else{
            $validacion["Actividades"]["resultado"] = "alert-success";
            $validacion["Actividades"]["mensaje"] = $acep . " " . $entregables_sin_activiad ;

        }


    }else{
        $validacion["Actividades"]["resultado"] = "alert-danger";
        $validacion["Actividades"]["mensaje"] = "Este proyecto no tiene actividades";
        $puede = false;
    }


//5. Presupuesto (financiado)
    $Gastos = $proyecto->gastos;
    $validacion["Financiamiento"]["categoria"] = "Financiamiento:";
    $cuantos=0;
    $total=0;
    $acep="<table border='1'><thead><th>DESCRIPCION</th><th>MONTO</th></thead><tbody>";
    foreach($Gastos as $gasto){
        $acep .= "<tr><td>$gasto->descripcion</td><td>$gasto->monto</td><tr>";
        $cuantos++;
        $total+=$gasto->monto;
    }
    $acep .= "</tbody></table>";
    if( $proyecto->financiado == 0 ){
        $validacion["Financiamiento"]["categoria"] = "Financiamiento:";
        $validacion["Financiamiento"]["resultado"] = "alert-warning";
        $validacion["Financiamiento"]["mensaje"] = "Este proyecto no es financiado por lo que no importa si tiene o no gastos";

    }else{

        if($cuantos!=0) {
            //////RESTRICCION DE MONTO MAXIMO
            $Restricciones = RestriccionesR::find(6);
            if($total >  $Restricciones->valor ) {
                $validacion["Financiamiento"]["resultado"] = "alert-danger";
                $validacion["Financiamiento"]["mensaje"] = "Este proyecto exede del monto a financiar";
                $puede = false;
            }else{
                $validacion["Financiamiento"]["resultado"] = "alert-success";
                $validacion["Financiamiento"]["mensaje"] = $acep;                
            }
        }else{
            $validacion["Financiamiento"]["resultado"] = "alert-danger";
            $validacion["Financiamiento"]["mensaje"] = "Este proyecto es financiado y no tiene gastos";
            $puede = false;
        }
    }





//6. Vinculacion
    $validacion["Vinculacion"]["categoria"] = "Vinculacion:";
    $validacion["Vinculacion"]["resultado"] = "alert-warning";

    if($proyecto->vinculacion=="") {
        if($proyecto->tvinculacion!=""){
            $validacion["Vinculacion"]["resultado"] = "alert-danger";
            $validacion["Vinculacion"]["mensaje"] = "Este proyecto no presenta carta de vinculacion pero dice tener vinculacion";
            $puede = false;
        }else{
            $validacion["Vinculacion"]["resultado"] = "alert-success";
            $validacion["Vinculacion"]["mensaje"] = "Este proyecto no presenta carta de vinculacion pero no dice tener vinculacion";
        }
    }else{
        $validacion["Vinculacion"]["resultado"] = "alert-success";
        $validacion["Vinculacion"]["mensaje"] = "Este proyecto presenta carta de vinculacion";
    }
//7. Existe Aval de academia
    $validacion["Aval"]["categoria"] = "Aval:";
    if($proyecto->aval=="") {
        $puede = false;
        $validacion["Aval"]["resultado"] = "alert-danger";
        $validacion["Aval"]["mensaje"] = "Este proyecto no presenta aval de academia";

    }else{
        $validacion["Aval"]["resultado"] = "alert-success";
        $validacion["Aval"]["mensaje"] = "Este proyecto presenta aval de academia";
    }
/////////////////    
/////////////////

        return view('someter/someter',compact('proyecto','validacion','puede'));
    }

    public function update(Request $request, $idproy)
    {

        $request->validate([
            'ci_01' => 'required|file|max:1024',
            'ci_02' => 'required|file|max:1024',

        ]);


        $fechaSometido = new \DateTime(); // Today
       // ob_start();
//        var_dump( $request->all());
        //$result = ob_get_clean();
        $extension01 = "";
        $extension02 = "";
        $extension01 = $request->file('ci_01')->getClientOriginalExtension();
        $extension02 = $request->file('ci_02')->getClientOriginalExtension();
        $fileName01 = $idproy . '_ci01' . '.' . $extension01;
        $fileName02 = $idproy . '_ci02' . '.' . $extension02;
        $path01 = Storage::putFileAs(
            '', $request->file('ci_01'), $fileName01
        );
        $path02 = Storage::putFileAs(
            '', $request->file('ci_02'), $fileName02
        );

        $proyecto= Someter::find($idproy);
        $proyecto->sometido = $fechaSometido->format('Y-m-d');
        $proyecto->ci01 = $path01;
        $proyecto->ci02 = $path02;
        $proyecto->save();
        return redirect('home')->with('success', "El proyecto \"$proyecto->titulo\" ha sido sometido en fecha \"$proyecto->sometido\".");
          //   return redirect('home')->with('success', "$result");
    }




}
