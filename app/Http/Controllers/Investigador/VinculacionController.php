<?php

namespace App\Http\Controllers\Investigador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Vinculacion;

class VinculacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Investigador');
    }

    public function mostrar($idproy)
    {
        $vinculacion= Vinculacion::find($idproy);
        $proyecto= Proyecto::find($idproy);
        return view('vinculacion/show',compact('proyecto','vinculacion'));
    }
    public function agregar(Request $request)
    {
        $idproy = $request->input('proyecto_id');
        $file = $request->file('evidencia');
        $extension = "";
        $extension = $file->getClientOriginalExtension();
        $fileName = $idproy . '_vinculacion' . '.' . $extension;
        $path = Storage::putFileAs(
            '', $request->file('evidencia'), $fileName
        );

        try {
            DB::beginTransaction();
            $Vinculacion= Vinculacion::find($idproy);
            $Vinculacion->vinculacion = $path;
            $Vinculacion->save();
            $path = public_path() . '/evidencias' . $path;
            $Retornar = array(
                'fileName' => $fileName,
                'proyecto_id' => $idproy,
            );
            DB::commit();
            return json_encode(array(
                     'error' => false, 
                     'mensaje' => $Retornar ));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return response()->json( array(
                     'error' => true, 
                     'mensaje' => 'DB::. ' . $error));
        }
    }

    public function eliminar(Request $request)
    {
        $Vinculacion = Vinculacion::find( $request->input('proyecto_id') );
        $fileName = $Vinculacion->vinculacion;
        $archivo = public_path() .'/evidencias/'.$fileName;
        $ret = "--";

        if (Storage::disk('local')->exists($fileName) ) {
            //return response()->download($url);
            $ret = Storage::disk('local')->delete($fileName) ;
            if($ret) $Vinculacion->Vinculacion = null;
            $Vinculacion->save();
            $realizado = "si";

        }else $realizado = "no";

        $arrayName = array('id' =>  $request->input('proyecto_id'),'realizado' => $ret , 'archivo'=> $archivo);
        return response()->json( $arrayName );
    }


}
