<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CrudCatalagoArea;


class CrudAreasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('role:Coordinador');
     }
    public function index()
    {
      $catalagos=DB::table('catalogo_areas')->get();
  return view ('crudareas/index', compact('catalagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('crudareas/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $catalago = new CrudCatalagoArea();
      $catalago->area = $request->get('area');
      $catalago->save();
      return redirect('crudareas');
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
      $catalagos = CrudCatalagoArea::find($id);
      return view('crudareas/edit',compact('catalagos','id'));
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
      $catalago = CrudCatalagoArea::find($id);
      $catalago->fill($request->all());
        $catalago->save();
        return redirect('crudareas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $catalago= CrudCatalagoArea::find($id);
    $catalago->delete();
        return redirect('crudareas');
    }
}
