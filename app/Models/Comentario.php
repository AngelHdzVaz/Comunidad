<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Persona as Per;
use App\Models\Publicacione as Pub;
use App\Models\Comentario as Com;
class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_noticia',
      'comentario_uuid',
      'autor_comentario_uuid',
      'comentario',
      'fecha'
    ];

    public function autor() {
      return $this->belongsTo(Per::class,'autor_comentario_uuid', 'uuid');
    }

    // returns post of any comment
    public function publicacion(){
      return $this->belongsTo(Pub::class,'id', 'id_publicacion');
    }

}
