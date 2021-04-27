<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_usuario',
      'codigo_usuario',
      'primer_nombre',
      'segundo_nombre',
      'apelllido paterno',
      'apellido materno',
      'fecha_nacimimiento',
      'genero',
      'pais'
];
}
