<?php

namespace App\Http\Controllers\Investigador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Proyecto;
use App\Models\Colaboradores;
//∫use App\Models\User;

class ColaboradoresController extends Controller
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
        $logeado = Auth::user();
        $proyecto= Proyecto::find($idproy);

        $investigadores = DB::table('users')
                    ->where('rol', 'Investigador')
                    ->where('id', '<>', $logeado->id)
                    ->whereRaw('id not in (select users_id from colaboradores where proyecto_id = ?)', [$idproy])
                    ->get();
       $colaboradores = DB::table('colaboradores')
            ->where('proyecto_id',$idproy)
            ->join('users', 'users.id', '=', 'colaboradores.users_id')
            ->select('users.id', 'users.cvutecnm', 'users.name', 'colaboradores.participacion')
            ->get();
        return view('colaboradores/index',compact('colaboradores','proyecto','investigadores'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invitar(Request $request)
    {
        try {
            DB::beginTransaction();
            $Colaboradores  = new Colaboradores();
            $Colaboradores->users_id=$request->input('users_id');
            $Colaboradores->proyecto_id=$request->input('proyecto_id');
            $Colaboradores->save();
            //cvu,nombre,aceptacion,eliminar
            $Colaborador = $Colaboradores->toArray();
            $Colaborador['cvutecnm'] = $Colaboradores->quien->cvutecnm;
            $Colaborador['name'] = $Colaboradores->quien->name;
            $Colaborador['participacion'] = $Colaboradores->proyecto->participacion;
            DB::commit();
            return json_encode(array(
                     'error' => false, 
                     'Colaborador' => $Colaborador ) );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return response()->json( array(
                     'error' => true, 
                     'mensaje' => 'DB ' . $error));
        }


/*
        $Retornar = DB::table('colaboradores')
            ->where('proyecto_id',$request->input('proyecto_id'))
            ->join('users', 'users.id', '=', 'colaboradores.users_id')
            ->select('users.id', 'users.cvutecnm', 'users.name', 'colaboradores.participacion')
            ->where('users.id',$request->input('users_id') )           
            ->get();
        return response()->json($Retornar);
*/
    }


    public function desinvitar(Request $request)
    {
        try {
            DB::beginTransaction();
            $Colaborador = Colaboradores::where('proyecto_id' , $request->input('proyecto_id') ) 
                ->where ('users_id' , $request->input('users_id') )
                ->delete();    
            DB::commit();
            return json_encode(array(
                     'error' => false, 
                     'Colaborador' => $request->input('users_id')  ) );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return response()->json( array(
                     'error' => true, 
                     'mensaje' => 'DB ' . $error));
        }
    }




    public function rechazar(Request $request)
    {
        $Colaboradores= Colaboradores::find($request->input('colaboracion'));
        if ($Colaboradores==null)
                $Retornar=array('colaboracion'=> $request->input('colaboracion'), 'rechazado' => false);
        else{
            $Colaboradores->delete();
            $Retornar=array('colaboracion'=> $request->input('colaboracion'), 'rechazado' => true);
        }
        return response()->json($Retornar);
    }



    public function aceptar(Request $request){
        $Colaboradores= Colaboradores::find($request->input('colaboracion'));
        if ($Colaboradores==null)
                $Retornar=array('colaboracion'=> $request->input('colaboracion'), 'aceptado' => false);
        else{
            $Colaboradores->participacion=1;
            $Colaboradores->save();
            $Retornar=array('colaboracion'=> $request->input('colaboracion'), 'aceptado' => true);
        }
        return response()->json($Retornar);        
    }

}
