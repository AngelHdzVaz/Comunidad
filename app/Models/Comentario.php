<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
      'uuid',
      'cuerpo',
      'tiempo'
    ];

    public function autor() {
      return $this->belongsTo('App\Models\Empresas_empleado', 'uuid');
    }

    // returns post of any comment
    public function publicacion()
    {
      return $this->belongsTo('App\Models\Publicacione', 'titulo');
    }

}
