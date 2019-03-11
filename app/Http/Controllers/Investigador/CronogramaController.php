<?php

namespace App\Http\Controllers\Investigador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Models\Proyecto;
use App\Models\Cronograma;




class CronogramaController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('role:Investigador');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idproy)
    {
        $proyecto= Proyecto::find($idproy);
        $opciones   = DB::table('entregables')
            ->where('proyecto_id',$idproy)
            ->get();

        $actividades =Cronograma::orderBy('fecha_inicio','DESC')
//                        ->orderBy('fecha_fin','DESC')
                        ->where('proyecto_id',$idproy)
                        ->get();
//       $actividades = Cronograma::all()
//                   ->where('proyecto_id',$idproy);
//                   ->orderBy('fecha_inicio','asc');

        return view('cronograma/index',compact('actividades','proyecto','opciones'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agregar(Request $request)
    {

//    <!--   id, actividad, fecha_inicio, fecha_fin, monto, proyecto_id, entregables_id  -->

        $Cronograma  = new Cronograma();
        $Cronograma->fill($request->all());
        $Cronograma->save();


        $arr=$Cronograma->toArray();
        $arr['entregable'] = $Cronograma->entregable->descripcion;
        return json_encode($arr);

    }


    public function eliminar(Request $request)
    {
        $Cronograma = Cronograma::find( $request->input('actividad_id') );
        $Cronograma->delete();
        $arrayName = array('id' =>  $request->input('actividad_id') );
        return response()->json( $arrayName );
    }

}
