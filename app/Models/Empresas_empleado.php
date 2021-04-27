<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas_empleado extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'codigo_empleado',
      'primer_nombre',
      'segundo nombre',
      'apellido paterno',
      'apellido materno',
      'estado_civil',
      'hijos',
      'genero',
      'lugar_nacimieto',
      'fecha_nacimimiento',
      'edad',
      'rfc',
      'curp',
      'n-seguro_social',
      'id_nivel_estudios',
      'id_estatus_estudio',
      'pais',
      'estado',
      'codigo_postal',
      'municipio',
      'colonia',
      'manzana',
      'lote',
      'numero_exterior',
      'numero interior'
];
}
