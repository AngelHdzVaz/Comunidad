<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_telefono extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'codigo_usuario',
      'codigo',
      'lada',
      'numero',
      'extension',
      'id_tipo'
];
}
