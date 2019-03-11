<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vinculacion extends Model
{
    protected $table='proyecto';
    public $timestamps =false;

   protected $fillable = [
         'vinculacion'];

}
