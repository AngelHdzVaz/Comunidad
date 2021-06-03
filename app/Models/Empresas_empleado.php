<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona as Per;
use App\Models\Personas_correo as PCor;
use App\Models\Usuario as Usua;
use App\Models\Usuarios_telefono as UTel;


class Empresas_empleado extends Model
{
    use HasFactory;
    protected $fillable = [
      'uuid',
      'codigo_empresa',
      'codigo_empleado',
      'estado_civil',
      'hijos',
      'genero',
      'lugar_nacimieto',
      'edad',
      'rfc',
      'curp',
      'n_seguro_social',
      'id_nivel_estudios',
      'id_estatus_estudio',
      'estado',
      'codigo_postal',
      'municipio',
      'colonia',
      'manzana',
      'lote',
      'numero_exterior',
      'numero interior',
      'tiempo_registro'
];

  public function persona_EEmp(){
    return $this->hasOne(Per::class,'uuid','uuid')->orderBy('apellido_paterno');
  }

  public function correo_EEmp(){
    return $this->hasOne(PCor::class,'uuid','uuid');
  }

  public function usuario_EEmp()
  {
    return $this->hasOne(Usua::class,'uuid','uuid');
  }

  public function telefonos_EEmp(){
    return $this->hasMany(UTel::class,'uuid_usuario_telefono','uuid');
  }

}
