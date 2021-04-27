<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    'codigo_empresa',
    'nombre_comercial',
    'marca_registrada',
    'logo',
    'giro',
    'pais',
    'estado',
    'municipio',
    'calle',
    'colonia',
    'manzana',
    'lote',
    'exterior',
    'interior',
    'referencias',
    'pagina_web',
    'codigo_postal',
    'id_persona_fiscal',
    'liberada',
    'tiempo_registro'
}
