<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona as Per;
use App\Models\Personas_correo as PCor;
use App\Models\Usuario as Usua;


class Empresas_empleado extends Model
{
    use HasFactory;
    protected $fillable = [
      'uuid',
      'codigo_empresa',
      'codigo_empleado',
      'primer_nombre',
      'segundo_nombre',
      'apellido_paterno',
      'apellido_materno',
      'estado_civil',
      'hijos',
      'genero',
      'lugar_nacimieto',
      'fecha_nacimimiento',
      'edad',
      'rfc',
      'curp',
      'n_seguro_social',
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

  public function persona_EEmp(){
    return $this->hasOne(Per::class,'uuid','uuid');
  }

  public function correo_EEmp(){
    return $this->hasOne(PCor::class,'uuid','uuid');
  }

  public function usuario_EEmp()
  {
    return $this->hasOne(Usua::class,'uuid','uuid');
  }

  public function posts(){
    return $this->hasMany('App\Posts', 'author_id');
  }

  // user has many comments
  public function comments(){
    return $this->hasMany('App\Comments', 'from_user');
  }


}
