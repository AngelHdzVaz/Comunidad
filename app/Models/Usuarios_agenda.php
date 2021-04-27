<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_agenda extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'condigo_intencion',
      'codigo_usuario',
      'codigo cliente',
      'tiempo_registro',
      'tiempo_compromiso',
      'id_tipo',
      'observaciones',
      'referencias',
      'id_estatus'
    ];
}
