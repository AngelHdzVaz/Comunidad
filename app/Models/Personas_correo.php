<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona as Per;
use App\Models\Empresas_empleado as EEmp;
use App\Models\Usuario as Usua;

class Personas_correo extends Model
{
    use HasFactory;
    protected $fillable = [
      'uuid',
      'id_persona',
      'email_empresa',
      'email_personal'
];
}
