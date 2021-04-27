<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas_equipos_trabajo extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'equipo',
      'descripcion',
      'id_tipo'
];

}
