<?php

namespace App\Http\Controllers\Coordinador;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passwords;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class CrudUsersController extends Controller
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
      $users = DB::table('users')->get();
     return view('crudusers/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ies = DB::table('catalogo_ies')->get();
        return view('crudusers/create', compact('ies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $user = new User();
                $user->name = $request->input('name');
                $user->cvutecnm = $request->input('cvutecnm');
                $user->adscripcion = $request->input('adscripcion');
                $user->email = $request->input('email');
                $user->password = $request->input('password');
                $user->save();
                return redirect('crudusers');
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
      $user = User::find($id);
    return view('crudusers/edit', compact('user', 'id'));
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


      $users = User::find($id);
        $users->fill($request->all());
        $users->save();
        return redirect('crudusers');
    }



    /**
     * Muestra por ajax los datos del usuario al que se cambiao el password.
     *
     * @param request
     * @return json con los datos del usuario modificado
     */
    public function cambiar(Request $request, $id)
    {

        $Usuarios = Passwords::find($id);
        if(is_null($Usuarios)){
            return redirect('crudusers')->with('error', 'No se econtraron los datos del usuario.');
        }
        $Usuarios->password = Hash::make($Usuarios->email ); 
        $Usuarios->save();
        return redirect('crudusers')->with('success','Password actualizado a "' . $Usuarios->email .'"');
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
          $users= User::find($id);
          $users->delete();
          return redirect('crudusers')->with('success','Usuario eliminado correctamente.');
        }catch (\Illuminate\Database\QueryException $e){
            if($e->getCode()==23000)  
                return redirect('crudusers')->with('error','No es posible eliminar a este usuario, verifique que no sea director o colaborador de un proyecto ya registrado.');
        }





    }
}
