<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat_telefonos_tipo as CTel;

class Usuarios_telefono extends Model
{
    use HasFactory;
    protected $fillable = [
      'uuid_usuario_telefono',
      'codigo_empresa',
      'codigo_usuario',
      'codigo',
      'lada',
      'numero',
      'extension',
      'id_tipo'
];

  public function catalogoTelefonos_UTel(){
    return $this->belongsTo(CTel::class,'id_tipo','id');
  }
}
