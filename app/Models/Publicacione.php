<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona as Per;
use App\Models\Comentario as Com;

class Publicacione extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'fecha_publicacion',
      'titulo',
      'resumen',
      'cuerpo',
      'autor',
      'activa'
    ];

    public function autor_pub(){
        return $this->belongsTo(Per::class,'autor','uuid');
    }

    public function comments_pub(){
      return $this->hasMany(Com::class,'id_noticia','id')->orderBy('created_at','asc');
    }


}
