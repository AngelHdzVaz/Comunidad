<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_equipo extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'codigo_usuario',
      'id_equipo',
      'responsable'
];
}
