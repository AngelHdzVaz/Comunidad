<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_usuario',
      'codigo_azul',
      'id_persona',
      'id_rango',
      'id_area',
      'id_perfil',
      'reporta_a',
      'codigo_empresa',
      'codigo_establecimiento',
      'foto',
      'email',
      'password',
      'acceso',
      'conexion',
      'noticias',
      'tiempo_registro',
      'id_pais',
      'zona_horaria',
      'config_inicial',
      'remeber_token'

];
}
