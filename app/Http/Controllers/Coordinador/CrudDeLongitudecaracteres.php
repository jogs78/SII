<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CrudLongitudCaracteres;

//ese nombre  CrudLongitudCaracteres no me convence pero bueno

class CrudDeLongitudecaracteres extends Controller
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
        //para que esta el modelo "RestriccionesL" entonces
      $longitud = DB::table('catalogo_restricciones_longitud')->get();
     return view('crudlongitudecaracteres/index', compact('longitud'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $longitud = CrudLongitudCaracteres::find($id);
      return view('crudlongitudecaracteres/edit',compact('longitud','id'));
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
      $longitud =CrudLongitudCaracteres::find($id);
      $longitud->valor = $request->get('valor');
      $longitud->save();
        return redirect('crudlongitudecaracteres');
    }

}
