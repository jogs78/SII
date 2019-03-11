<?php

namespace App\Http\Controllers\Investigador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Passwords;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra por los datos del usuario al que se cambiara el password.
     *
     * @param request
     * @return json con los datos del usuario modificado
     */
    public function cambiar(Request $request, $id)
    {
				$user = User::find($id);
				return view('crudusers/cambiar', compact('user', 'id'));
    }

    /**
     * Muestra por los datos del usuario al que se cambiara el password.
     *
     * @param request
     * @return json con los datos del usuario modificado
     */
    public function actualizar(Request $request, $id)
    {

				$Usuarios = Passwords::find($id);	

        $campos = $request->all();
        $puede = false;
        if ( !Hash::check($campos['pwda'],$Usuarios->password)) {
          return redirect('home')->with('error', 'El password anterior no coincide con el guardado en la b.d.');
        }
        if ($campos['pwd2'] != $campos['password']){
            return redirect('home')->with('error', 'El nuevo password no se repitio correctamente.');
        }
        $campos['password'] = Hash::make($campos['password']);
        $Usuarios->fill($campos);
        $Usuarios->save();
        return redirect('home')->with('success','Password actualizado correctamente');

    }
}