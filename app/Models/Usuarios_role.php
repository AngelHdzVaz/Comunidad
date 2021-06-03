<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat_role as CRol;

class Usuarios_role extends Model
{
    use HasFactory;
    protected $fillable = [
      'uuid_usuario_rol',
      'codigo_empresa',
      'codigo_usuario',
      'id_rol',

];

public function catalogoRoles_URol(){
  return $this->hasOne(CRol::class,'id_rol','id');
}
}
