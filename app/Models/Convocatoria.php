<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    protected $table='convocatoria';
    public $timestamps =false;


   protected $fillable = [ 'Nombre', 'Fecha_inicio', 'Fecha_fin'];

	public function proyectos()
	{
	    return $this->hasMany('App\Models\Proyecto');
	}        
	public function vigente(){

        $ConvocatoriaFechaInicio = new \DateTime($this->Fecha_inicio);
        $ConvocatoriaFechaFin  = new \DateTime($this->Fecha_fin);
        $fechaHoy = new \DateTime(); // Today
        $fechaHoy->format('d/m/Y'); // echos today!

        if(
          $fechaHoy->getTimestamp() >= $ConvocatoriaFechaInicio->getTimestamp() &&
          $fechaHoy->getTimestamp() <= $ConvocatoriaFechaFin->getTimestamp() ){
			return true;
		}else{
 	       return false;
        }


	}

}
