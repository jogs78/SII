<?php

namespace App\Http\Controllers\Coordinador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CrudGastos;
class CrudGastosController extends Controller
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
        $gastos=DB::table('catalogo_gastos')->get();
        return view('crudgastos/index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crudgastos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $gastos = new CrudGastos();
      $gastos->descripcion = $request->get('descripcion');
      $gastos->partida = $request->get('partida');
      $gastos->save();
      return redirect('crudgastos');
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
      $gastos =CrudGastos::find($id);
      return view('crudgastos/edit', compact('gastos','id'));
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
      $gastos =CrudGastos::find($id);
    $gastos->descripcion = $request->get('descripcion');
    $gastos->partida = $request->get('partida');
    $gastos->save();
    return redirect('crudgastos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $gastos=CrudGastos::find($id);
      $gastos->delete();
      return redirect('crudgastos');
    }
}
