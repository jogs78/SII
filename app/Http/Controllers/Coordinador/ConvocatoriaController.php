<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Convocatoria;

class ConvocatoriaController extends Controller
{

    /**
     * Aquí se inicializa y se dice que solo el Coordinador puede accesar a este controlador
     */
      public function __construct()
      {
          $this->middleware('role:Coordinador');
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $convocatorias=Convocatoria::orderBy('Fecha_inicio','desc')->get();
        return view('convocatoria/index',compact('convocatorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('convocatoria/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $convocatoria= new Convocatoria();
        $convocatoria->Nombre = $request->get('Nombre');
        $convocatoria->Fecha_inicio  = $request->get('Fecha_inicio');
        $convocatoria->Fecha_fin  = $request->get('Fecha_fin');
        $convocatoria->save();
        return redirect('convocatoria')->with('success', 'Information ha sido agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convocatoria = Convocatoria::find($id);
        return view('convocatoria/edit',compact('convocatoria','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $convocatoria= Convocatoria::find($id);
        $convocatoria->Nombre = $request->get('Nombre');
        $convocatoria->Fecha_inicio  = $request->get('Fecha_inicio');
        $convocatoria->Fecha_fin  = $request->get('Fecha_fin');
        $convocatoria->save();
        return redirect('convocatoria')->with('success', 'Information ha sido actualizada');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $convocatoria= Convocatoria::find($id);
            $convocatoria->delete();
            return redirect('convocatoria')->with('success','Informacion ha sido borrada');
        }catch (\Illuminate\Database\QueryException $e){
            if($e->getCode()==23000) return redirect('convocatoria')->with('error', 'Convocatoria en uso por al menos un proyecto');;
        }


    }

}
