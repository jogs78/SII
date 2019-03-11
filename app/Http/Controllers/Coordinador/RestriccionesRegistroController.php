<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RestriccionesR;



class RestriccionesRegistroController extends Controller
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
      $restricciones = RestriccionesR::all();
     return view('restriccionesr/index', compact('restricciones'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $restriccion = RestriccionesR::find($id);
      return view('restriccionesr/edit',compact('restriccion','id'));
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
      $restriccion =RestriccionesR::find($id);
      $restriccion->valor = $request->get('valor');
      $restriccion->save();
        return redirect('home');
    }

}
