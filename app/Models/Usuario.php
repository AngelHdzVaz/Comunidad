<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
      'uuid',
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
