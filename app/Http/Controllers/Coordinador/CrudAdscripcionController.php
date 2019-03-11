<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CrudAdscripcion;

class CrudAdscripcionController extends Controller
{
      public function __construct()
      {
          $this->middleware('role:Coordinador');
      }
    /*  *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $ie=DB::table('catalogo_ies')->get();
      return view ('crudadscripcion/index', compact('ie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('crudadscripcion/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tipo = new CrudAdscripcion();
      $tipo->ies = $request->get('ies');
      $tipo->save();
      return redirect('crudadscripcion');
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
      $ies =  CrudAdscripcion::find($id);
      return view('crudadscripcion/edit',compact('ies','id'));
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
      $ies = CrudAdscripcion::find($id);
      $ies->fill($request->all());
        $ies->save();
        return redirect('crudadscripcion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $ies= CrudAdscripcion::find($id);
      $ies->delete();
      return redirect('crudadscripcion');
    }
}
