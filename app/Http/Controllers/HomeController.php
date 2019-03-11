<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyecto;

use App\Models\Convocatoria;

use App\Models\CrudCatalagoArea;
use App\Models\CrudGastos;
use App\Models\CrudLineas;
use App\Models\CrudEntregable;
use App\Models\CrudTipodeinvestigacion;
use App\Models\CrudLongitudCaracteres;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->input('page')) $hayg=true;
        else $hayg = false;
        if (\Session::has('page')) $hays=true;
        else $hays = false;

        if( $hayg == false && $hays == false ){
            $page=true;
        }
        if( $hayg == false && $hays == true  ){
            $page = \Session::get('page');
        }
        if( $hayg == true  && $hays == false ){
            $page=$request->input('page');
            \Session::put('page' ,  $request->input('page') );
        }
        if( $hayg == true  && $hays == true  ){
            $page=$request->input('page');
            \Session::put('page' ,  $request->input('page') );
        }
        $request->merge( array( 'page' => $page ) );

        $logeado = Auth::user();


        switch ($logeado->rol) {
            case 'Investigador':
                $convocatorias=Convocatoria::orderByDesc("Fecha_inicio")->paginate(2);

                $convocatorias->currentPage($page);
                return view('sistema.Investigador',compact('convocatorias'));
                break;
            case 'Coordinador':
            $count = User::all()->count();
            $countareas= CrudCatalagoArea::all()->count();
            $entregable= CrudEntregable::all()->count();
            $proyecto = Proyecto::all()->count();
            $convocatorias =Convocatoria::all()->count();
            $catalogo = CrudCatalagoArea::all()->count();
            $gastos = CrudGastos::all()->count();
            $lineas = CrudLineas::all()->count();
            $tipo = CrudTipodeinvestigacion::all()->count();
            // $ci    = User::where('rol','Investigador')->count();
            //   $cii    = User::where('rol','Coordinador')->count();
//                $countproyect = Proyecto::all()->count();
//
//
            return view('sistema.Coordinador',compact('count','countareas','entregable','proyecto','convocatorias',
            'catalogo','entregable','gastos','lineas','tipo', 'longitud'));

                break;
//            default:
//                return view('sistema.home');
//                break;
        }
    }
}
