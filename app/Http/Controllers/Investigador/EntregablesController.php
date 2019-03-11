<?php

namespace App\Http\Controllers\Investigador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Models\Proyecto;
use App\Models\Entregables;


class EntregablesController extends Controller
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

        $opciones = DB::table('catalogo_entregables')
//                        ->select('id','descripcion')
                        ->get();

        $entregables  = DB::table('entregables')
            ->where('proyecto_id',$idproy)
            ->get();
        $tipos = DB::table('catalogo_entregables')
            ->distinct('tipo')
            ->select('tipo')
            ->get();

        return view('entregables/index',compact('entregables','proyecto','opciones','tipos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agregar(Request $request)
    {
        if ($request->input('cuantos') == 0 ){
            $Retornar  = array('error' => "Debe especificar una cantidad" );
            return response()->json($Retornar);

        }
        $Entregables  = new Entregables();
        $Entregables->tipo=$request->input('tipo');
        $Entregables->cuantos=$request->input('cuantos');
        $Entregables->descripcion=$request->input('descripcion');
        $Entregables->proyecto_id=$request->input('proyecto_id');
        $Entregables->save();
        $Retornar= $Entregables;
        // $Retornar = DB::table('entregables')
        //     ->where('proyecto_id',$request->input('proyecto_id'))
        //     ->
        //     ->get();

        return response()->json($Retornar);
    }


    public function eliminar(Request $request)
    {
        $Entregables = Entregables::find( $request->input('entregable_id') );
        $Entregables->delete();
        $arrayName = array('id' =>  $request->input('entregable_id') );
        return response()->json( $arrayName );
    }

}
