<?php

namespace App\Http\Controllers\Coordinador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CrudTipodeinvestigacion;
use Illuminate\Support\Facades\DB;

class CrudInvestigacionsController extends Controller
{
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
      $tipos = DB::table('catalogo_tipo_investigacion')->get();
     return view('crudinvestigacion/index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('crudinvestigacion/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new CrudTipodeinvestigacion();
        $tipo->tipo = $request->get('tipo');
        $tipo->save();
        return redirect('crudinvestigacion');
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
      $tipo = CrudTipodeinvestigacion::find($id);
        return view('crudinvestigacion/edit', compact('tipo','id'));
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
       $tipo = CrudTipodeinvestigacion::find($id);
       $tipo->tipo=$request->get('tipo');
       $tipo->save();
       return redirect('crudinvestigacion');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $linea=CrudTipodeinvestigacion::find($id);
      $linea->delete();
      return redirect('crudinvestigacion');
    }
}
