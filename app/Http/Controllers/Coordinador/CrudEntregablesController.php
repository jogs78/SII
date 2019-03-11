<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\CrudEntregable;
use Illuminate\Support\Facades\DB;


class CrudEntregablesController extends Controller
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
      $entregables=DB::table('catalogo_entregables')->get();
        return view ('crudentregables/index', compact('entregables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('crudentregables/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entregable = new CrudEntregable();
        $entregable->descripcion = $request->get('descripcion');
        $entregable->tipo = $request->get('tipo');
        $entregable->save();
        return redirect('crudentregables');
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
      $entregable =CrudEntregable::find($id);
      return view('crudentregables/edit', compact('entregable','id'));
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
      $entregable =CrudEntregable::find($id);
      $entregable->fill($request->all());
      $entregable->save();
      return redirect('crudentregables');//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $entregable=CrudEntregable::find($id);
      $entregable->delete();
      return redirect('crudentregables');
    }
}
