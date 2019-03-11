<?php

namespace App\Http\Controllers\Coordinador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Programa_educativo;

class CrudProgramaEducativo extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Coordinador');
    }

    public function index()
    {
          $programaeducativo=DB::table('catalogo_pe')->get();
      return view ('crudpe/index', compact('programaeducativo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('crudpe/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = Programa_educativo::create($request->all());        
        $tipo->save();
        return redirect('crudpe');    
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
       $programaeducativo = Programa_educativo::find($id);
       return view('crudpe/edit', compact('programaeducativo','id'));
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
      $programaeducativo= Programa_educativo::find($id);
      $programaeducativo->fill($request->all());
        $programaeducativo->save();
        return redirect('crudpe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $lineas= Programa_educativo::find($id);
      $lineas->delete();
      return redirect('crudpe');
        //
    }
}
