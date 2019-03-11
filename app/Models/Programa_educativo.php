<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa_educativo extends Model
{
	protected $table='catalogo_pe';
	public $timestamps =false;
	protected $fillable = [
          'programa', 'nivel', 'actreditado_habilitado', 'pnpc'];
//	public function proyecto(){
//		return 
//		  $this->belongsTo('App\Models\Proyecto', 'proyecto_id');
//	}
}
