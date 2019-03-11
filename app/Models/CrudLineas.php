<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrudLineas extends Model
{
  protected $table='catalogo_lineas';
  protected $fillable = ['linea'];
  public $timestamps =false;
}
