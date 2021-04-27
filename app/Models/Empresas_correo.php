<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas_correo extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'codigo_establecimiento',
      'correo',
      'id_tipo'

];
}
