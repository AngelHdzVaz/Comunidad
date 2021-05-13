<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresas_empleado as EEmp;
use App\Models\Personas_correo as PCor;
use App\Models\Usuario as Usua;


class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_usuario',
      'uuid',
      'codigo_usuario',
      'primer_nombre',
      'segundo_nombre',
      'apellido_paterno',
      'apellido_materno',
      'fecha_nacimimiento',
      'genero',
      'pais'
    ];
}
